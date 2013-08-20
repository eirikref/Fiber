<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\String;

/**
 * Fiber: Unit tests for String::getEmpty()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-08-20
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetEmptyTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Check getEmpty() directly
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-18
     * @access public
     * @covers \Fiber\String::getEmpty
     */
    public function getEmptyDirectly()
    {
        $string = new \Fiber\String();
        $this->assertEquals("", $string->getEmpty());
    }
}
