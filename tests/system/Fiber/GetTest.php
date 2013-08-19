<?php
/**
 * Fiber: System tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\System\Fiber;

/**
 * Fiber: System tests for Fiber::get()
 *
 * @package    Fiber
 * @subpackage System
 * @version    2013-08-19
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Basic test of Fiber::get()
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-24
     * @access public
     * @covers \Fiber\Fiber::get
     */
    public function simpleGet()
    {
        $fiber  = new \Fiber\Fiber();
        $config = '{ "include": "bool, array, object" }';
        $exp    = array(array(true), array(false), array(array()), array(new \StdClass()));

        $this->assertEquals($exp, $fiber->get($config));
    }



    /**
     * Testing Fiber::get() with two params
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-19
     * @access public
     * @covers \Fiber\Fiber::get
     */
    public function twoParams()
    {
        $fiber  = new \Fiber\Fiber();
        $param1 = '{ "include": "bool" }';
        $param2 = '{ "include": "bool" }';
        $exp    = array(array(true, true),
                        array(true, false),
                        array(false, true),
                        array(false, false));

        $this->assertEquals($exp, $fiber->get($param1, $param2));
    }



    /**
     * Testing Fiber::get() with two params, a single static value,
     * and simple config
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-19
     * @access public
     * @covers \Fiber\Fiber::get
     */
    public function twoParamsPlusStaticSimpleConfig()
    {
        $fiber  = new \Fiber\Fiber();
        $param1 = "bool";
        $param2 = "static string";
        $param3 = "object";
        $exp    = array(array(true,  "static string", new \StdClass()),
                        array(false, "static string", new \StdClass()));

        $this->assertEquals($exp, $fiber->get($param1, $param2, $param3));
    }
}
