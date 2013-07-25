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
class ValidateConfigInvalidTest extends \PHPUnit_Framework_TestCase
{

    /**
     * FIXME: Should of course be replace with Fiber generated data
     * once things are done :)
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-10
     * @access public
     * @return array
     */
    public function getNonArrayParams()
    {
        return array(array(0),
                     array(1024),
                     array(-1),
                     array("fisk"),
                     array(false),
                     array(true),
                     array(3.14),
                     array(-3.14),
                     array(new \stdClass()));
    }



    /**
     * Test validateConfig() with non-array parameters
     *
     * This may be seriously unnecessary since the method signature
     * already checks that $config is an array. But... oh well.
     *
     * @test
     * @author            Eirik Refsdal <eirikref@gmail.com>
     * @since             2013-07-10
     * @access            public
     * @covers            \Fiber\Base::validateConfig
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider      getNonArrayParams
     *
     * @param             mixed $param Non-array parameter
     */
    public function CheckInvalidParams($param)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\Base");
        $method = new \ReflectionMethod($mock, "validateConfig");
        $method->setAccessible(true);

        $method->invokeArgs($mock, array($param));
    }



    /**
     * Data provider for JSON or arrays where the format is kind of
     * valid, but the contents of $config is the real issue
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-23
     * @access public
     * @return array
     */
    public function getInvalidContents()
    {
        return array(array(array("include" => "true", "exclude" => "false")),
                     array(array("include" => "true", "include" => "false"))
        );
    }



    /**
     * Test validateConfig() with invalid JSON or arrays
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-07-23
     * @access       public
     * @covers       \Fiber\Base::validateConfig
     * @dataProvider getInvalidContents
     *
     * @param        mixed $param Non-valid config
     */
    public function CheckInvalidContents($param)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\Base");
        $method = new \ReflectionMethod($mock, "validateConfig");
        $method->setAccessible(true);

        $method->invokeArgs($mock, array($param));
    }
}
