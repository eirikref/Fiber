<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\Object;

/**
 * Fiber: Unit tests for Object::getStdClass()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-18
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class StdClassTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Check getStdClass() directly
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-18
     * @access public
     * @covers \Fiber\Object::getStdClass
     */
    public function getStdClass()
    {
        $this->assertEquals(new \stdClass(), \Fiber\Object::getStdClass());
    }
}
