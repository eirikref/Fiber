<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\Base;

/**
 * Fiber: Unit tests for Base::validateConfig()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-25
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ValidateConfigValidTest extends \PHPUnit_Framework_TestCase
{

    /**
     * FIXME: Just placeholder data until we properly implement
     * Base::validateConfig()
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-10
     * @access public
     * @return array
     */
    public function getParams()
    {
        return array(array(array("test")),
                     array(array())
        );
    }



    /**
     * Test validateConfig() with valid parameters
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-07-10
     * @access       public
     * @covers       \Fiber\Base::validateConfig
     * @dataProvider getParams
     *
     * @param        array $param
     */
    public function CheckValidParams($param)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\Base");
        $method = new \ReflectionMethod($mock, "validateConfig");
        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($mock, array($param)));
    }
}
