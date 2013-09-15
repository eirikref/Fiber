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
 * @version    2013-08-19
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class CompactConfigTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Make sure the compact config format passes through and ends up
     * the way we expect it to
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-19
     * @access public
     * @covers \Fiber\Fiber::get
     */
    public function getWithInvalidConfig()
    {
        $fiber    = new \Fiber\Fiber();
        $config   = "bool";
        $expected = array(array(true), array(false));

        // $this->assertEquals($expected, $fiber->get($config));
    }
}
