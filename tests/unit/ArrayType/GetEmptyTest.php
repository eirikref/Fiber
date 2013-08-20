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
 * @version    2013-08-20
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetEmptyArrayTest extends \PHPUnit_Framework_TestCase
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
        $cfg = json_encode(array("include" => "empty"));

        $gen = new \Fiber\ArrayType();
        $this->assertEquals($exp, $gen->get($cfg));
    }



    /**
     * Get through the main Fiber class
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-16
     * @access public
     * @covers \Fiber\ArrayType::getEmpty
     */
    public function getEmptyThroughFiber()
    {
        $exp = array(array(array()));
        $raw = array("include" => "array",
                     "array"   => array("include" => "empty"));
        $cfg = json_encode($raw);

        $fiber = new \Fiber\Fiber();
        $this->assertEquals($exp, $fiber->get($cfg));
    }
}
