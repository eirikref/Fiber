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
 * @version    2013-07-19
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class CombineParamsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider for testing basic data combination
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-05
     * @access public
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
     * Basic combination test
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-07-05
     * @access       public
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
     * Data provider for testing complex data combination
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-13
     * @access public
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
     * A bit more complex combination test
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-07-13
     * @access       public
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



    /**
     * Data provider for testing prependValue
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-14
     * @access public
     * @return array
     */
    public function getPrependValueData()
    {
        return array(array(array(array(array("b"),
                                       array("c")),
                                 "a"),
                           array(array("a", "b"),
                                 array("a", "c"))),
                     array(array(array(array(12),
                                       array(-1)),
                                 false),
                           array(array(false, 12),
                                 array(false, -1))),
        );
    }



    /**
     * Test prependValue()
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-07-14
     * @access       public
     * @covers       \Fiber\DataType::prependValue
     * @dataProvider getPrependValueData
     */
    public function testPrependValue($params, $expected)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\DataType");
        $method = new \ReflectionMethod($mock, "prependValue");

        $method->setAccessible(true);
        $this->assertEquals($expected, $method->invokeArgs($mock, $params));
    }



    /**
     * Data provider for testing prependArray
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-14
     * @access public
     * @return array
     */
    public function getPrependArrayData()
    {
        return array(array(array(array(array("b"),
                                       array("c")),
                                 array(1, 2)),
                           array(array(1, "b"),
                                 array(1, "c"),
                                 array(2, "b"),
                                 array(2, "c"))),

                     array(array(array(array(12),
                                       array(-1)),
                                 array(true, false)),
                           array(array(true, 12),
                                 array(true, -1),
                                 array(false, 12),
                                 array(false, -1))),
        );
    }



    /**
     * Test prependArray()
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-07-14
     * @access       public
     * @covers       \Fiber\DataType::prependArray
     * @dataProvider getPrependArrayData
     */
    public function testPrependArray($params, $expected)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\DataType");
        $method = new \ReflectionMethod($mock, "prependArray");

        $method->setAccessible(true);
        $this->assertEquals($expected, $method->invokeArgs($mock, $params));
    }



    /**
     * Test corner case of combineParams
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-19
     * @access public
     * @covers \Fiber\DataType::combineParams
     */
    public function combineEmptyArray()
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\DataType");
        $method = new \ReflectionMethod($mock, "combineParams");
        $method->setAccessible(true);

        $input    = array(array());
        $expected = array(array(array()));
        
        $this->assertEquals($expected, $method->invokeArgs($mock, array($input)));
    }
}
