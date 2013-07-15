<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\DataType;

/**
 * Fiber: Unit tests for Array::getEmptyArray()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-15
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class getEmptyArrayTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Get an empty array
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-15
     * @access public
     * @covers \Fiber\ArrayType::getEmpty
     */
    public function getEmptyDirectly()
    {
        $exp = array();

        $this->assertEquals($exp, \Fiber\ArrayType::getEmpty());
    }
}
