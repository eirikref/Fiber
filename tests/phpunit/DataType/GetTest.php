<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\DataType;

/**
 * Fiber: Unit tests for DataType::get()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-20
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Use Boolean class to test DataType::get
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-20
     * @access public
     * @covers \Fiber\DataType::get
     */
    public function simpleGet()
    {
        $boolean  = new \Fiber\Boolean();
        $expected = array(array(true, false));

        $this->assertEquals($expected, $boolean->get());
    }



    /**
     * Use Boolean class to test DataType::get with JSON config
     *
     * Pass along config in JSON format, and check the output to see
     * that the config was parsed the way we expected it to.
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-20
     * @access public
     * @covers \Fiber\DataType::get
     */
    public function getWithJsonConfig()
    {
        $boolean  = new \Fiber\Boolean();
        $json     = '{ "include": "true" }';
        $expected = array(array(true));

        $this->assertEquals($expected, $boolean->get($json));
    }



    /**
     * Use Boolean class to test DataType::get with invalid JSON config
     *
     * Pass along config in JSON format, and check the output to see
     * that the config was parsed the way we expected it to.
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-20
     * @access public
     * @covers \Fiber\DataType::get
     */
    public function getWithInvalidConfig()
    {
        $this->markTestSkipped();

        $boolean  = new \Fiber\Boolean();
        $json     = '{ "include": "true", "exclude": "true" }';
        $expected = array(array(true));

        $this->assertFalse($boolean->get($json));
    }
}
