<?php

namespace Fiber\Tests\DataType;

class ConstructorTest extends \PHPUnit_Framework_TestCase
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
     * Test constructor with non-array parameters
     *
     * This may be seriously unnecessary since the method signature
     * already checks that $options is an array. But... oh well.
     *
     * @Xtest
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider      getNonArrayParams
     */
    public function ConstructorWithInvalidParams($param)
    {
        $gen = $this->getMockForAbstractClass("\Fiber\DataType", array($param));
    }



    /**
     * @Xtest
     * @covers \Fiber\Datatype::__construct
     */
    public function ConstructorWithValidParam()
    {
        $gen = $this->getMockForAbstractClass("\Fiber\DataType", array(array()));
    }
}
