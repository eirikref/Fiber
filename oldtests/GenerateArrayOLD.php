<?php

namespace Fiber\Tests\DataType;

class DummyDataType extends \Fiber\DataType
{
    protected $options = array("foo" => array("active" => true,
                                              "action" => "getFoo"),
                               "bar" => array("active" => true,
                                              "action" => "getBar")
                               );
    
    public function getFoo()
    {
        return "foo";
    }

    public function getBar()
    {
        return "bar";
    }
}


class GenerateArrayTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * Test simple data generation without "params" settings in
     * $options
     *
     * @Xtest
     */
    public function getDataWithoutParams()
    {
        $exp = array(array("foo"),
                     array("bar"));

        $dummy = new DummyDataType();
        $this->assertEquals($exp, $dummy->get());
    }



    /**
     * Test data generation with correct use of "params"
     *
     * @Xtest
     */
    public function correctParamsUse()
    {
        $exp = array(array("test", "foo"),
                     array("test", "bar"));
        $opt = array("params" => array("test", "__GEN__"));

        $dummy = new DummyDataType($opt);
        $this->assertEquals($exp, $dummy->get());
    }



    /**
     * Test data generation with strange use of "params"
     *
     * @Xtest
     */
    public function paramsJustGen()
    {
        $exp = array(array("foo"),
                     array("bar"));
        $opt = array("params" => array("__GEN__"));

        $dummy = new DummyDataType($opt);
        $this->assertEquals($exp, $dummy->get());
    }


    /**
     * Test data generation with strange use of "params"
     *
     * @Xtest
     */
    public function paramsJustText()
    {
        $exp = array(array("test"),
                     array("test"));
        $opt = array("params" => array("test"));

        $dummy = new DummyDataType($opt);
        $this->assertEquals($exp, $dummy->get());
    }
}

