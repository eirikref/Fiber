<?php

class NullBasicTest extends PHPUnit_Framework_TestCase
{

    /**
     * @covers \Fiber\Null
     */
    public function singleParam()
    {
        $exp       = array(array(null));
        $generator = new \Fiber\Null();
        
        $this->assertEquals($exp, $generator->get());
    }



    /**
     * @covers \Fiber\Null
     */
    public function twoParams()
    {
        $exp       = array(array("test", null));
        $opts      = array("params" => array("test", "__GEN__"));
        $generator = new \Fiber\Null($opts);
        
        $this->assertEquals($exp, $generator->get());
    }



    /**
     * @covers \Fiber\Null
     */
    public function multipleParams()
    {
        $exp       = array(array("test", null, "foo", "bar"));
        $opts      = array("params" => array("test", "__GEN__", "foo", "bar"));
        $generator = new \Fiber\Null($opts);
        
        $this->assertEquals($exp, $generator->get());
    }
}