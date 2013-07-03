<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\DataType;

/**
 * Fiber: Unit tests for DataType::isJson()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-03
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
     * Make sure non-valid JSON does not pass
     *
     * @test
     * @covers       \Fiber\DataType::isJson
     * @dataProvider getInvalidJson
     */
    public function checkNonJson($param)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\DataType");
        $method = new \ReflectionMethod($mock, "isJson");
        
        $method->setAccessible(true);
        $this->assertFalse($method->invokeArgs($mock, array($param)));
    }



    /**
     * Make sure valid JSON passes
     *
     * @test
     * @covers       \Fiber\DataType::isJson
     * @dataProvider getValidJson
     */
    public function checkJson($param)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\DataType");
        $method = new \ReflectionMethod($mock, "isJson");
        
        $method->setAccessible(true);
        $this->assertTrue($method->invokeArgs($mock, array($param)));
    }
}
