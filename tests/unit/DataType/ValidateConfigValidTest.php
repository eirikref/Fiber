<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\DataType;

/**
 * Fiber: Unit tests for DataType::validateConfig()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-10
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ValidateConfigValidTest extends \PHPUnit_Framework_TestCase
{

    /**
     * FIXME: Just placeholder data until we properly implement
     * DataType::validateConfig()
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
     * @covers       \Fiber\DataType::validateConfig
     * @dataProvider getParams
     */
    public function CheckValidParams($param)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\DataType");
        $method = new \ReflectionMethod($mock, "validateConfig");
        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($mock, array($param)));
    }
}
