<?php

class BasicTest extends PHPUnit_Framework_TestCase
{

    public function testBasic()
    {
        $exp       = array(array("test", true),
                           array("test", false));
        $opts      = array("params" => array("test", "__GEN__"));
        $generator = new \Fiber\Boolean($opts);
        
        $this->assertEquals($exp, $generator->get());
    }
}