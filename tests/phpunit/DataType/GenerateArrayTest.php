<?php

namespace Fiber\Tests\DataType;

class GenerateArrayTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * Test that setOptions() ignore non-existant items
     *
     * We use reflection to manipulate our way to a mock with proper
     * $this->options from the get-go, try to change an item, and then
     * use reflection again to check that the variable has been not
     * been set.
     *
     * @test
     */
    public function setOptionsThatDoNotExist()
    {
    //     $before = array("first"  => array("active" => true,
    //                                       "action" => "doSomething"),
    //                     "second" => array("active" => true,
    //                                       "action" => "doAnything"));
    //     $opts   = array("third"  => array("active" => false,
    //                                       "action" => "doNothing"));

    //     $gen  = $this->getMockForAbstractClass("\Fiber\DataType");

    //     $prop = new \ReflectionProperty($gen, "options");
    //     $prop->setAccessible(true);
    //     $prop->setValue($gen, $before);

    //     $gen->setOptions($opts);
    //     $this->assertEquals($before, $prop->getValue($gen));
    // }
    //     $gen->get();
    }
}
