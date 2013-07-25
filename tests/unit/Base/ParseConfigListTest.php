<?php
/**
 * Fiber: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\Tests\Base;

/**
 * Fiber: Unit tests for Base::parseConfigList()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2013-07-25
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ParseConfigListTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider for some config lists and the expected size of
     * the result
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-22
     * @access public
     * @return array
     */
    public function getConfigListsAndResultSizes()
    {
        return array(array("a", 1),
                     array("a, b, c", 3),
                     array("", 0)
        );
    }



    /**
     * Check the number of items in the result
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-07-22
     * @access       public
     * @covers       \Fiber\Base::parseConfigList
     * @dataProvider getConfigListsAndResultSizes
     *
     * @param        string $configList
     * @param        int    $expSize
     */
    public function checkExpectedResultSize($configList, $expSize)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\Base");
        $method = new \ReflectionMethod($mock, "parseConfigList");
        $method->setAccessible(true);

        $res = $method->invokeArgs($mock, array($configList));
        $this->assertEquals(count($res), $expSize);
    }



    /**
     * Data provider for just about anything that is not a valid
     * configList param
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-22
     * @access private
     * @return array
     */
    public function getInvalidConfigLists()
    {
        return array(array(0),
                     array(1024),
                     array(-1),
                     array(array("test")),
                     array(false),
                     array(true),
                     array(3.14),
                     array(-3.14),
                     array(new \stdClass())
        );
    }



    /**
     * Check that non-strings result in an empty array
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-07-22
     * @access       public
     * @covers       \Fiber\Base::parseConfigList
     * @dataProvider getInvalidConfigLists
     *
     * @param        mixed $invalidParam
     */
    public function invalidParamsShouldResultInEmptyArray($invalid)
    {
        $expected = array();
        $mock     = $this->getMockForAbstractClass("\Fiber\Base");
        $method   = new \ReflectionMethod($mock, "parseConfigList");
        $method->setAccessible(true);
        
        $this->assertEquals($expected, $method->invokeArgs($mock, array($invalid)));
    }



    /**
     * Data provider for variations of spacing and commas within the
     * configList param
     * 
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-22
     * @access private
     * @return array
     */
    public function getCommaAndWhitespaceVariations()
    {
        return array(array("a, b"),
                     array("a,b"),
                     array(" a,b"),
                     array("  a,b"),
                     array("a,  b"),
                     array("a,b "),
                     array("a,b  "),
                     array("  a  ,  b  ")
        );
    }



    /**
     * Check that variations in comma and whitespace placing does not
     * matter
     *
     * @test
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2013-07-22
     * @access       public
     * @covers       \Fiber\Base::parseConfigList
     * @dataProvider getCommaAndWhitespaceVariations
     *
     * @param        mixed $param
     */
    public function testVariationsInCommaAndWhitespacePlacement($param)
    {
        $expected = array("a", "b");
        $mock     = $this->getMockForAbstractClass("\Fiber\Base");
        $method   = new \ReflectionMethod($mock, "parseConfigList");
        $method->setAccessible(true);
        
        $this->assertEquals($expected, $method->invokeArgs($mock, array($param)));
    }

}
