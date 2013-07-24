<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\Integer;

/**
 * Fiber: Unit tests for Integer::getZero()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-18
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class getZeroTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Check getZero() directly
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-18
     * @access public
     * @covers \Fiber\Integer::getZero
     */
    public function getZeroDirectly()
    {
        $int = new \Fiber\Integer();
        $this->assertEquals(0, $int->getZero());
        $this->assertTrue(is_int($int->getZero()));
    }
}
