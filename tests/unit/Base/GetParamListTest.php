<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\Base;

/**
 * Fiber: Unit tests for Base::getParamList()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-25
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetParamListTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Use Boolean class to test an "include" configList
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-22
     * @access public
     * @covers \Fiber\Base::getParamList
     */
    public function testIncludeConfigList()
    {
        $config   = array("include" => "true");
        $valid    = array("true" => "getTrue", "false" => "getFalse");
        $expected = array("true");
        $mock     = $this->getMockForAbstractClass("\Fiber\Boolean");
        $method   = new \ReflectionMethod($mock, "getParamList");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($config, $valid));
        $this->assertEquals($expected, $res);
    }



    /**
     * Use Boolean class to test an "exclude" configList
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-22
     * @access public
     * @covers \Fiber\Base::getParamList
     */
    public function testExcludeConfigList()
    {
        $config   = array("exclude" => "true");
        $valid    = array("true" => "getTrue", "false" => "getFalse");
        $expected = array("false");
        $mock     = $this->getMockForAbstractClass("\Fiber\Boolean");
        $method   = new \ReflectionMethod($mock, "getParamList");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($config, $valid));
        $this->assertEquals($expected, $res);
    }



    /**
     * Use Boolean class to test without configList
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-22
     * @access public
     * @covers \Fiber\Base::getParamList
     */
    public function testWithoutConfigList()
    {
        $config   = array();
        $valid    = array("true" => "getTrue", "false" => "getFalse");
        $expected = array("true", "false");
        $mock     = $this->getMockForAbstractClass("\Fiber\Boolean");
        $method   = new \ReflectionMethod($mock, "getParamList");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($config, $valid));
        $this->assertEquals($expected, $res);
    }
}
