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
 * @version    2013-07-25
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test with invalid config
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-25
     * @access public
     * @covers \Fiber\Fiber::get
     */
    public function getWithInvalidConfig()
    {
        $fiber  = new \Fiber\Fiber();
        $config = array("include" => "bool", "exclude" => "bool");

        $this->assertNull($fiber->get($config));
    }



    /**
     * Test with datatype sub-config
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-25
     * @access public
     * @covers \Fiber\Fiber::get
     */
    public function getWithSubConfig()
    {
        $fiber    = new \Fiber\Fiber();
        $config   = array("include" => "bool", "bool" => array("include" => "true"));
        $expected = array(array(true));

        $this->assertEquals($expected, $fiber->get($config));
    }
}
