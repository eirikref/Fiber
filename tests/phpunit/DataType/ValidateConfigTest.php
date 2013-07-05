<?php

namespace Fiber\Tests\DataType;

class ValidateConfigTest extends \PHPUnit_Framework_TestCase
{

    /**
     * FIXME: Should of course be replace with Fiber generated data
     * once things are done :)
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
     * @covers            \Fiber\DataType::validateConfig
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider      getNonArrayParams
     */
    public function CheckInvalidParams($param)
    {
        $mock   = $this->getMockForAbstractClass("\Fiber\DataType");
        $method = new \ReflectionMethod($mock, "validateConfig");
        
        $method->setAccessible(true);
        $method->invokeArgs($mock, array($param));
    }
}
