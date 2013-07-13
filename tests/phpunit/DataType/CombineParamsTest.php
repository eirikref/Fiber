<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\DataType;

/**
 * Fiber: Unit tests for DataType::combineParams()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-13
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class CombineParamsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider for testing basic data combination
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-05
     * @access private
     * @return array
     */
    public function getBasicCombinationData()
    {
        return array(
            array(array("test"),
                  array(array("test"))),
            array(array("test", "best"),
                  array(array("test", "best"))),
            array(array(array(true, false)),
                  array(array(true),
                        array(false))),
            array(array("test", array(true, false)),
                  array(array("test", true),
                        array("test", false))),
            array(array(array(true, false), "test"),
                  array(array(true, "test"),
                        array(false, "test")))
        );
    }



    /**
     * Data provider for testing complex data combination
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-13
     * @access private
     * @return array
     */
    public function getComplexCombinationData()
    {
        return array(
            array(array(array(7, 0, -1), "test", array("a", "b"), array(true, false)),
                  array(
                      array(7, "test", "a", true),
                      array(7, "test", "a", false),
                      array(7, "test", "b", true),
                      array(7, "test", "b", false),

                      array(0, "test", "a", true),
                      array(0, "test", "a", false),
                      array(0, "test", "b", true),
                      array(0, "test", "b", false),

                      array(-1, "test", "a", true),
                      array(-1, "test", "a", false),
                      array(-1, "test", "b", true),
                      array(-1, "test", "b", false),
                  )
            )
        );
    }



    /**
     * Basic combination test
     *
     * @test
     * @covers       \Fiber\DataType::combineParams
     * @dataProvider getBasicCombinationData
     */
    public function basicCombination($params, $expected)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\DataType");
        $method = new \ReflectionMethod($mock, "combineParams");
        
        $method->setAccessible(true);
        $this->assertEquals($expected, $method->invokeArgs($mock, array($params)));
    }



    /**
     * A bit more complex combination test
     *
     * @test
     * @covers       \Fiber\DataType::combineParams
     * @dataProvider getComplexCombinationData
     */
    public function complexCombination($params, $expected)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\DataType");
        $method = new \ReflectionMethod($mock, "combineParams");
        
        $method->setAccessible(true);
        $this->assertEquals($expected, $method->invokeArgs($mock, array($params)));
    }
}
