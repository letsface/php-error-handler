<?php

namespace Letsface;

class ExceptionHandler
{
    /** @var \Pimple */
    private $_handlers;

    public function __construct()
    {
        $this->_handlers = new \Pimple();
    }

    public function listen($code, \Closure $callable)
    {
        $this->_handlers[(string) $code] = $this->_handlers->protect($callable);
    }

    public function throws($code, $class, $message = '', $newCode = 0)
    {
        $this->_handlers[(string) $code] = $this->_handlers->protect(function($e) use ($class, $message, $newCode){
            throw new $class($message, $newCode, $e);
        });
    }

    public function rethrow($code)
    {
        $this->_handlers[(string) $code] = $this->_handlers->protect(function($e){
            throw $e;
        });
    }

    public function handle(\Exception $e)
    {
        $code = $e->getCode();
        // if there is no handler for this do nothing
        if (!$this->_handlers->offsetExists($code)) {
          return;
        }

        return $this->_handlers[$code]($e);
    }
}
