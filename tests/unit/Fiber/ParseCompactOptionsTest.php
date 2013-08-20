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



    /**
     * Data provider for charsets (and similar). Not quite sure just
     * yet what I should include/allow here and not.
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-20
     * @access public
     * @return array
     */
    public function getCharsets()
    {
        return array(array("utf8"),
                     array("latin1"));
    }



    /**
     * Make sure we are able to parse charset
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-08-20
     * @access       public
     * @covers       \Fiber\Fiber::parseCompactOptions
     * @dataProvider getCharsets
     *
     * @param        string $config
     */
    public function testCharsetParsing($config)
    {
        $expected = array("charset" => $config);
        $mock     = $this->getMockForAbstractClass("\Fiber\Fiber");
        $method   = new \ReflectionMethod($mock, "parseCompactOptions");
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs($mock, array($config)));
    }



    /**
     * Data provider for combined otions
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-20
     * @access public
     * @return array
     */
    public function getCombinedData()
    {
        return array(array("utf8:1-1000",
                           array("charset" => "utf8", "min" => 1, "max" => 1000)),
                     array("1-5:latin1",
                           array("min" => 1, "max" => 5, "charset" => "latin1")));
    }



    /**
     * Make sure we are able to parse charset
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-08-20
     * @access       public
     * @covers       \Fiber\Fiber::parseCompactOptions
     * @dataProvider getCombinedData
     *
     * @param        string $config
     */
    public function testCombinedParsing($config, $expected)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\Fiber");
        $method = new \ReflectionMethod($mock, "parseCompactOptions");
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs($mock, array($config)));
    }
}
