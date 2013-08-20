<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\Fiber;

/**
 * Fiber: Unit tests for Fiber::get()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-08-20
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ParseCompactOptionsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider for invalid compact config format strings
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-05
     * @access public
     * @return array
     */
    public function getInvalidParamsDynamic()
    {
        $fiber = new \Fiber\Fiber();
        return $fiber->get("!string<1-128>");
    }



    /**
     * Make sure invalid config formats fail
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-08-05
     * @access       public
     * @covers       \Fiber\Fiber::parseCompactOptions
     * @dataProvider getInvalidParamsDynamic
     *
     * @param        string $config
     */
    public function makeSureInvalidParamsFailDynamic($config)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\Fiber");
        $method = new \ReflectionMethod($mock, "parseCompactOptions");
        $method->setAccessible(true);

        $this->assertNull($method->invokeArgs($mock, array($config)));
    }



    /**
     * Handle ranges
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-05
     * @access public
     * @covers \Fiber\Fiber::parseCompactOptions
     */
    public function testRangeParsing()
    {
        $opts     = "1-2";
        $expected = array("min" => 1,
                          "max" => 2);
        $mock     = $this->getMockForAbstractClass("\Fiber\Fiber");
        $method   = new \ReflectionMethod($mock, "parseCompactOptions");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($opts));

        $this->assertEquals($expected, $res);
    }
}
