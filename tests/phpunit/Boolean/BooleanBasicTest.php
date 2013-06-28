<?php

class BooleanBasicTest extends PHPUnit_Framework_TestCase
{

    public function testBooleanSingleParam()
    {
        $exp       = array(array(true),
                           array(false));
        $generator = new \Fiber\Boolean();
        
        $this->assertEquals($exp, $generator->get());
    }



    public function testBooleanTwoParams()
    {
        $exp       = array(array("test", true),
                           array("test", false));
        $opts      = array("params" => array("test", "__GEN__"));
        $generator = new \Fiber\Boolean($opts);
        
        $this->assertEquals($exp, $generator->get());
    }



    public function testBooleanMultipleParams()
    {
        $exp       = array(array("test", true, "foo", "bar"),
                           array("test", false, "foo", "bar"));
        $opts      = array("params" => array("test", "__GEN__", "foo", "bar"));
        $generator = new \Fiber\Boolean($opts);
        
        $this->assertEquals($exp, $generator->get());
    }
}