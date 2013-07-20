<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\DataType;

/**
 * Fiber: Unit tests for DataType::getArray()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-20
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetArrayTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Use Boolean class to test DataType::getArray
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-20
     * @access public
     * @covers \Fiber\DataType::getArray
     */
    public function simpleGetArray()
    {
        $boolean  = new \Fiber\Boolean();
        $expected = array(true, false);

        $this->assertEquals($expected, $boolean->getArray());
    }
}
