<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\DataType;

/**
 * Fiber: Unit tests for DataType::combineParams()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-17
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class BooleanTest extends PHPUnit_Framework_TestCase
{

    /**
    /**
     * Data provider for testing basic data combination
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-05
     * @access public
     * @return array
     */
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