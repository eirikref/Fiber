<?php

namespace Fiber\Tests\DataType;

class ValidateConfigValidTest extends \PHPUnit_Framework_TestCase
{

    /**
     * FIXME: Just placeholder data until we properly implement
     * DataType::validateConfig()
     */
    public function getParams()
    {
        return array(array(array("test")));
    }



    /**
     * Test validateConfig() with valid parameters
     *
     * @test
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
