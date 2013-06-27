<?php

namespace Fiber;

class Boolean extends DataType
{
    
    protected $options = array("true"  => array("active" => true,
                                                "action" => "getTrue"),
                               "false" => array("active" => true,
                                                "action" => "getFalse")
                               );


    
    public function get()
    {
        $test = $this->generateArray();
        return $test;
    }



    public function getTrue()
    {
        return true;
    }


    
    public function getFalse()
    {
        return false;
    }
}