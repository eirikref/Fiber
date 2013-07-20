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
 * @version    2013-07-20
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Basic test of Fiber::get()
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-20
     * @access public
     * @covers \Fiber\Fiber::get
     */
    public function simpleGet()
    {
        $fiber = new \Fiber\Fiber();
        $exp   = array(array(array()));

        $this->assertEquals($exp, $fiber->get());
    }
}
