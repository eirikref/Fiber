<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\ArrayType;

/**
 * Fiber: Unit tests for Array::getEmptyArray()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-19
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class getEmptyArrayTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Get an empty array directly
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-15
     * @access public
     * @covers \Fiber\ArrayType::getEmpty
     */
    public function getEmptyDirectly()
    {
        $exp = array();

        $this->assertEquals($exp, \Fiber\ArrayType::getEmpty());
    }



    /**
     * Get through the ArrayData class
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-16
     * @access public
     * @covers \Fiber\ArrayType::getEmpty
     */
    public function getEmptyThroughArrayType()
    {
        $exp = array(array(array()));
        $cfg = json_encode(array("include" => array("empty")));

        $gen = new \Fiber\ArrayType($cfg);
        $this->assertEquals($exp, $gen->get());
    }



    /**
     * Get through the main Fiber class
     *
     * @Xtest
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-16
     * @access public
     * @covers \Fiber\ArrayType::getEmpty
     */
    public function getEmptyThroughFiber()
    {
        $exp = array(array(array()));
        $cfg = json_encode(array("include" => array("array"),
                                 "array"   => array("include" => array("empty"))
        ));

        $fiber = new \Fiber\Fiber($cfg);
        $this->assertEquals($exp, $fiber->get());
    }
}
