<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\Fiber;

/**
 * Fiber: Unit tests for Fiber::parseCompactConfig()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-08-19
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ParseCompactConfigTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider for invalid compact config format strings
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-05
     * @access public
     * @return array
     */
    public function getInvalidCompactConfig()
    {
        return array(array(""),
                     array("doesnotexist")
        );
    }



    /**
     * Make sure invalid config formats fail
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-08-05
     * @access       public
     * @covers       \Fiber\Fiber::parseCompactConfig
     * @dataProvider getInvalidCompactConfig
     *
     * @param        string $config
     */
    public function makeSureInvalidParamsFail($config)
    {
        $expected = array("value" => $config);
        $mock     = $this->getMockForAbstractClass("\Fiber\Fiber");
        $method   = new \ReflectionMethod($mock, "parseCompactConfig");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($config));

        $this->assertEquals($expected, $res);
    }



    /**
     * Get just booleans
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-05
     * @access public
     * @covers \Fiber\Fiber::parseCompactConfig
     */
    public function getOnlyBooleans()
    {
        $config   = "bool";
        $expected = array("include" => "bool");
        $mock     = $this->getMockForAbstractClass("\Fiber\Fiber");
        $method   = new \ReflectionMethod($mock, "parseCompactConfig");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($config));

        $this->assertEquals($expected, $res);
    }



    /**
     * Get anything but booleans
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-05
     * @access public
     * @covers \Fiber\Fiber::parseCompactConfig
     */
    public function getAnythingButBooleans()
    {
        $config   = "!bool";
        $expected = array("exclude" => "bool");
        $mock     = $this->getMockForAbstractClass("\Fiber\Fiber");
        $method   = new \ReflectionMethod($mock, "parseCompactConfig");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($config));

        $this->assertEquals($expected, $res);
    }



    /**
     * Strings with sub-config
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-05
     * @access public
     * @covers \Fiber\Fiber::parseCompactConfig
     */
    public function getStringsWithSubConfig()
    {
        $config   = "string<1-32>";
        $expected = array("include" => "string",
                          "string"  => array("min" => 1,
                                             "max" => 32));
        $mock     = $this->getMockForAbstractClass("\Fiber\Fiber");
        $method   = new \ReflectionMethod($mock, "parseCompactConfig");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($config));

        $this->assertEquals($expected, $res);
    }
}
