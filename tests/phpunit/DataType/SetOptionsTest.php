<?php

namespace Fiber\Tests\DataType;

class DataTypeTest extends \PHPUnit_Framework_TestCase
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
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider      getNonArrayParams
     */
    public function testWithNonArrayParams($param)
    {
        $gen = $this->getMockForAbstractClass("\Fiber\DataType");
        $gen->setOptions($param);
    }

    // 1. Setting options that exist
    // 2.                 that DO NOT exist
    // 3. Setting params

    
    
    /**
     * Test that using setOptions() to change values actually work.
     *
     * We use reflection to manipulate our way to a mock with proper
     * $this->options from the get-go, try to change an item, and then
     * use reflection again to check that the variable has been
     * changed.
     *
     * @test
     */
    public function setOptionsThatExist()
    {
        $before = array("first"  => array("active" => true,
                                          "action" => "doSomething"),
                        "second" => array("active" => true,
                                          "action" => "doAnything"));
        $opts   = array("second" => array("active" => false,
                                          "action" => "doNothing"));
        $after  = array("first"  => array("active" => true,
                                          "action" => "doSomething"),
                        "second" => array("active" => false,
                                          "action" => "doNothing"));

        $gen  = $this->getMockForAbstractClass("\Fiber\DataType");

        $prop = new \ReflectionProperty($gen, "options");
        $prop->setAccessible(true);
        $prop->setValue($gen, $before);

        $gen->setOptions($opts);
        $this->assertEquals($after, $prop->getValue($gen));
    }



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
        $before = array("first"  => array("active" => true,
                                          "action" => "doSomething"),
                        "second" => array("active" => true,
                                          "action" => "doAnything"));
        $opts   = array("third"  => array("active" => false,
                                          "action" => "doNothing"));

        $gen  = $this->getMockForAbstractClass("\Fiber\DataType");

        $prop = new \ReflectionProperty($gen, "options");
        $prop->setAccessible(true);
        $prop->setValue($gen, $before);

        $gen->setOptions($opts);
        $this->assertEquals($before, $prop->getValue($gen));
    }



    /**
     * Test that we can set $this->params using setOptions()
     *
     * Include "params" in the parameter sent to setOptions(), and use
     * reflection to check that $this->params has been set
     * accordingly.
     *
     * @test
     */
    public function setParams()
    {
        $opts = array("params" => array("test", "__GEN__", "somevalue"));
        $exp  = array("test", "__GEN__", "somevalue");
        
        $gen  = $this->getMockForAbstractClass("\Fiber\DataType");
        $prop = new \ReflectionProperty($gen, "params");
        $prop->setAccessible(true);
        $this->assertEmpty($prop->getValue($gen));

        $gen->setOptions($opts);
        
        $this->assertEquals($exp, $prop->getValue($gen));
    }

    
    // public function testConstructor()
    // {
    //     $gen = $this->getMockForAbstractClass("\Fiber\DataType");
    //     $ref = new \ReflectionProperty($gen, "options");
    //     $ref->setAccessible(true);
    //     $ref->setValue($gen, array("fisk"));
    //     // Cprint_r($gen);

    //     $gen->get();
    // }
}
