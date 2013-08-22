<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\String;

/**
 * Fiber: Unit tests for String::generateString()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-08-21
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GenerateStringTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider for non-integer values
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-21
     * @access public
     * @return array
     */
    public function getNonIntegers()
    {
        $fiber = new \Fiber\Fiber();
        return $fiber->get("!int<1->");
    }



    /**
     * Make sure non-integers fails
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-08-21
     * @access       public
     * @covers       \Fiber\String::generateString
     * @dataProvider getNonIntegers
     *
     * @param        mixed $len
     */
    public function makeSureNonIntegersFail($len)
    {
        $len    = 0;
        $string = new \Fiber\String();
        $out    = $string->generateString($len);

        $this->assertInternalType("string", $out);
        $this->assertEquals($len, strlen($out));
    }


    /**
     * Simple test
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-21
     * @access public
     * @covers \Fiber\String::generateString
     */
    public function simpleTest()
    {
        $len    = 10;
        $string = new \Fiber\String();
        $out    = $string->generateString($len);

        $this->assertInternalType("string", $out);
        $this->assertEquals($len, strlen($out));
    }
}
