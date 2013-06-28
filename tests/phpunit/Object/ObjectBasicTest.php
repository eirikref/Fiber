<?php

class ObjectBasicTest extends PHPUnit_Framework_TestCase
{

    public function testObjectSingleParam()
    {
        $exp       = array(array(new stdClass()));
        $generator = new \Fiber\Object();
        
        $this->assertEquals($exp, $generator->get());
    }



    public function testObjectTwoParams()
    {
        $exp       = array(array("test", new stdClass()));
        $opts      = array("params" => array("test", "__GEN__"));
        $generator = new \Fiber\Object($opts);
        
        $this->assertEquals($exp, $generator->get());
    }



    public function testObjectMultipleParams()
    {
        $exp       = array(array("test", new stdClass(), "foo", "bar"));
        $opts      = array("params" => array("test", "__GEN__", "foo", "bar"));
        $generator = new \Fiber\Object($opts);
        
        $this->assertEquals($exp, $generator->get());
    }
}