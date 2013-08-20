<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\Fiber;

/**
 * Fiber: Unit tests for Fiber::flattenSet()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-08-20
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class FlattenSetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Simple test of flattenSet just to see that it does what is
     * expected when the stars are aligned (and the input is
     * straightforward).
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-19
     * @access public
     * @covers \Fiber\Fiber::flattenSet
     */
    public function simpleFlattenSet()
    {
        $in       = array(1, 2, array("a", "b"), 3);
        $expected = array(1, 2, "a", "b", 3);
        $mock     = $this->getMockForAbstractClass("\Fiber\Fiber");
        $method   = new \ReflectionMethod($mock, "flattenSet");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($in));

        $this->assertEquals($expected, $res);
    }
}
