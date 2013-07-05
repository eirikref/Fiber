<?php

class BooleanBasicTest extends PHPUnit_Framework_TestCase
{

    /**
     * @covers \Fiber\Boolean
     */
    public function singleParam()
    {
        $exp       = array(array(true),
                           array(false));
        $generator = new \Fiber\Boolean();
        
        $this->assertEquals($exp, $generator->get());
    }



    /**
     * @covers \Fiber\Boolean
     */
    public function twoParams()
    {
        $exp       = array(array("test", true),
                           array("test", false));
        $opts      = array("params" => array("test", "__GEN__"));
        $generator = new \Fiber\Boolean($opts);
        
        $this->assertEquals($exp, $generator->get());
    }



    /**
     * @covers \Fiber\Boolean
     */
    public function multipleParams()
    {
        $exp       = array(array("test", true, "foo", "bar"),
                           array("test", false, "foo", "bar"));
        $opts      = array("params" => array("test", "__GEN__", "foo", "bar"));
        $generator = new \Fiber\Boolean($opts);
        
        $this->assertEquals($exp, $generator->get());
    }
}