<?php

namespace Fiber\Tests\DataType;

class ValidateItemInvalid extends \PHPUnit_Framework_TestCase
{
    
    private $gen;
    private $prop;
    
    public function setUp()
    {
        $this->gen  = $this->getMockForAbstractClass("\Fiber\DataType");
        $this->prop = new \ReflectionMethod($this->gen, "validateItem");
        $this->prop->setAccessible(true);
    }



    public function getInvalidOptionsItems()
    {
        return array(array(array("action" => "getSomething")),
                     array(array("active" => false)),
                     array(array("active" => true)),
                     array(array("active" => true,
                                 "action" => -1)),
                     array(array("active" => true,
                                 "action" => 0)),
                     array(array("active" => true,
                                 "action" => 1024)),
                     array(array("active" => true,
                                 "action" => -3.14)),
                     array(array("active" => true,
                                 "action" => -3.14)),
                     array(array("active" => true,
                                 "action" => true)),
                     array(array("active" => true,
                                 "action" => false)),
                     array(array("active" => true,
                                 "action" => null)),
                     array(array("active" => true,
                                 "action" => array())),
                     array(array("active" => true,
                                 "action" => new \stdClass())),
                     array(array("active" => true,
                                 "action" => "")),
                     array(array("active" => true,
                                 "action" => "abcdefghijklmnopqrstuvwxyzabcdefg")),
                     array(array("active" => true,
                                 "action" => "invalidMethod"))
                     );
    }



    /**
     * Test all kinds of invalid option items
     *
     * @Xtest
     * @dataProvider getInvalidOptionsItems
     */
    public function invalidOptionsItems($item)
    {
        $this->assertFalse($this->prop->invokeArgs($this->gen, array($item)));
    }



    /**
     * Test single valid
     *
     * @Xtest
     */
    public function validOptionsItem()
    {
        $item = array("active" => true, 
                      "action" => "setOptions");

        $this->assertTrue($this->prop->invokeArgs($this->gen, array($item)));
    }
}