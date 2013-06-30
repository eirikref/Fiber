<?php

namespace Fiber\Tests\DataType;

class InvalidGenerateArrayTest extends \PHPUnit_Framework_TestCase
{

    private $gen;
    private $prop;
    
    public function setUp()
    {
        $getSomething = function() {
            return "something";
        };
        
        $this->gen  = $this->getMockForAbstractClass("\Fiber\DataType");
        $this->prop = new \ReflectionProperty($this->gen, "options");
        $this->prop->setAccessible(true);
    }



    /**
     * item["active"] not set
     *
     * @test
     */
    public function activeIsNotSet()
    {
        $opts = array("first" => array("action" => "getSomething"));
        $this->prop->setValue($this->gen, $opts);

        $this->assertEmpty($this->gen->get());
    }
}
