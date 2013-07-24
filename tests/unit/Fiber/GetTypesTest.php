<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\Fiber;

/**
 * Fiber: Unit tests for Fiber::getTypes()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-24
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetTypesTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Check default types
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-18
     * @access public
     * @covers \Fiber\Fiber::getTypes
     */
    public function getDefaultTypes()
    {
        $fiber   = new \Fiber\Fiber();
        $defSize = 3;

        $this->assertTrue(is_array($fiber->getTypes()));
        $this->assertEquals($defSize, count($fiber->getTypes()));
    }
}
