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
 * @version    2013-07-11
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class CombineParamsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider for testing data combination
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-05
     * @access private
     * @return array
     */
    public function getCombinationData()
    {
        return array(
            // array(array(array("test")),
            //       array(array("test"))),
            array(array(array("test", "best")),
                  array(array("test", "best"))),
            array(array(array(true, false)),
                  array(array(true),
                        array(false))),
            array(array("test", array(true, false)),
                  array(array("test", true),
                        array("test", false))),
            array(array(array(true, false), "true"),
                  array(array(true, "test"),
                        array(false, "test")))
        );
    }



    /**
     * Basic combination test
     *
     * @test
     * @covers       \Fiber\DataType::combineParams
     * @dataProvider getCombinationData
     */
    public function basicCombination($params, $expected)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\DataType");
        $method = new \ReflectionMethod($mock, "combineParams");
        
        $method->setAccessible(true);
        // $this->assertEquals($expected, $method->invokeArgs($mock, $params));
        $tmp =  $method->invokeArgs($mock, $params);

        // print_r($expected);
        // print_r($tmp);
    }
}
