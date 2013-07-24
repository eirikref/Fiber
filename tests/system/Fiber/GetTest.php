<?php
/**
 * Fiber: System tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\System\Fiber;

/**
 * Fiber: System tests for Fiber::get()
 *
 * @package    Fiber
 * @subpackage System
 * @version    2013-07-24
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Basic test of Fiber::get()
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-24
     * @access public
     * @covers \Fiber\Fiber::get
     */
    public function simpleGet()
    {
        $fiber  = new \Fiber\Fiber();
        $config = '{ "include": "boolean, array, object" }';
        $exp    = array(array(true,  array(), new \StdClass()),
                        array(false, array(), new \StdClass()));

        $this->assertEquals($exp, $fiber->get($config));
    }
}
