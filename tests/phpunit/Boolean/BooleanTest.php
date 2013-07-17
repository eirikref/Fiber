<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\DataType;

/**
 * Fiber: Unit tests for DataType::combineParams()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-17
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class BooleanTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Check getTrue() directly
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-17
     * @access public
     * @covers \Fiber\Boolean::getTrue
     */
    public function getTrueDirectly()
    {
        $this->assertTrue(\Fiber\Boolean::getTrue());
    }



    /**
     * Check getFalse() directly
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-17
     * @access public
     * @covers \Fiber\Boolean::getFalse
     */
    public function getFalseDirectly()
    {
        $this->assertFalse(\Fiber\Boolean::getFalse());
    }
}
