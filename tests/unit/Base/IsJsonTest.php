<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\Base;

/**
 * Fiber: Unit tests for Base::isJson()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-25
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class IsJsonTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider for just about anything that is not JSON
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-03
     * @access private
     * @return array
     */
    public function getInvalidJson()
    {
        return array(array(0),
                     array(1024),
                     array(-1),
                     array("fisk"),
                     array(false),
                     array(true),
                     array(3.14),
                     array(-3.14),
                     array(new \stdClass())
                     );
    }



    /**
     * Make sure non-valid JSON does not pass
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-07-05
     * @access       public
     * @covers       \Fiber\Base::isJson
     * @dataProvider getInvalidJson
     *
     * @param        mixed $param Non-JSON payload
     */
    public function checkNonJson($param)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\Base");
        $method = new \ReflectionMethod($mock, "isJson");
        $method->setAccessible(true);

        $this->assertFalse($method->invokeArgs($mock, array($param)));
    }



    /**
     * Data provider for valid JSON
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-03
     * @access private
     * @return array
     */
    public function getValidJson()
    {
        return array(
                     array('{ "fisk": "kanin" }')
                     );
    }



    /**
     * Make sure valid JSON passes
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-07-05
     * @access       public
     * @covers       \Fiber\Base::isJson
     * @dataProvider getValidJson
     *
     * @param        string $param JSON payload
     */
    public function checkJson($param)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\Base");
        $method = new \ReflectionMethod($mock, "isJson");
        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($mock, array($param)));
    }
}
