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

    /**
     * @param string $code
     * @param callable $callable
     */
    public function listen($code, \Closure $callable)
    {
        $this->_handlers[(string) $code] = $this->_handlers->protect($callable);
    }

    /**
     * @param string $code
     * @param \Exception $exception
     */
    public function throws($code, \Exception $exception)
    {
        $this->_handlers[(string) $code] = $this->_handlers->protect(function($e) use ($exception){
            throw $exception;
        });
    }

    /**
     * @param string $code
     */
    public function rethrow($code)
    {
        $this->_handlers[(string) $code] = $this->_handlers->protect(function($e){
            throw $e;
        });
    }

    /**
     * @param \Exception $e
     */
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
