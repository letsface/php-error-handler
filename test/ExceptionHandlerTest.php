<?php

class ExceptionHandlerTest extends \PHPUnit_Framework_TestCase
{

    public function testListen()
    {
        $handler = new \Letsface\ExceptionHandler();

        $handler->listen('123', function() {return 'toto';});
        $this->assertEquals('toto', $handler->handle(new \Exception('', '123')));

        // check listen identical code replaces it
        $handler->listen('123', function() {return 'tata';});
        $this->assertEquals('tata', $handler->handle(new \Exception('', '123')));
    }

    public function testThrow()
    {
        $handler = new \Letsface\ExceptionHandler();

        $handler->throws('123', '\PdoException', 'Some message');
        try {
            $handler->handle(new \Exception('', '123'));
        }
        catch(\PdoException $e) {
            $this->assertEquals('Some message', $e->getMessage());
        }
    }

    public function testRethrow()
    {
        $handler = new \Letsface\ExceptionHandler();

        $handler->rethrow('123');
        try {
            $handler->handle(new \Exception('', '123'));
        }
        catch(\Exception $e) {
            $this->assertEquals('123', $e->getCode());
        }
    }
}
