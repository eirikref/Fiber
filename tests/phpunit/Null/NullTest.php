<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\Null;

/**
 * Fiber: Unit tests for the Null data type
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-18
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class NullTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Check getNull() directly
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-18
     * @access public
     * @covers \Fiber\Null::getNull
     */
    public function getNullDirectly()
    {
        $this->assertNull(\Fiber\Null::getNull());
    }
}
