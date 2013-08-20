<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\Float;

/**
 * Fiber: Unit tests for Float::getZero()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-08-20
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetZeroTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Check getZero() directly
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-18
     * @access public
     * @covers \Fiber\Float::getZero
     */
    public function getZeroDirectly()
    {
        $float = new \Fiber\Float();
        $this->assertEquals(0.0, $float->getZero());
        $this->assertTrue(is_float($float->getZero()));
    }
}
