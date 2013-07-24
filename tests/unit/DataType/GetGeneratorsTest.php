<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\DataType;

/**
 * Fiber: Unit tests for DataType::getGenerators()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-22
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetGeneratorsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Use Boolean class to test an "include" configList
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-22
     * @access public
     * @covers \Fiber\DataType::getGenerators
     */
    public function testIncludeConfigList()
    {
        $config   = array("include" => "true");
        $expected = array("true");
        $mock     = $this->getMockForAbstractClass("\Fiber\Boolean");
        $method   = new \ReflectionMethod($mock, "getGenerators");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($config));
        $this->assertEquals($expected, $res);
    }



    /**
     * Use Boolean class to test an "exclude" configList
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-22
     * @access public
     * @covers \Fiber\DataType::getGenerators
     */
    public function testExcludeConfigList()
    {
        $config   = array("exclude" => "true");
        $expected = array("false");
        $mock     = $this->getMockForAbstractClass("\Fiber\Boolean");
        $method   = new \ReflectionMethod($mock, "getGenerators");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($config));
        $this->assertEquals($expected, $res);
    }



    /**
     * Use Boolean class to test without configList
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-22
     * @access public
     * @covers \Fiber\DataType::getGenerators
     */
    public function testWithoutConfigList()
    {
        $config   = array();
        $expected = array("true", "false");
        $mock     = $this->getMockForAbstractClass("\Fiber\Boolean");
        $method   = new \ReflectionMethod($mock, "getGenerators");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($config));
        $this->assertEquals($expected, $res);
    }
}
