<?php

namespace Fiber;

class Boolean extends DataType
{
    
    private $options = array("true"  => array("active" => true,
                                              "action" => "getTrue"),
                             "false" => array("active" => true,
                                              "action" => "getFalse")
                             );


    
    public function get()
    {
        $test = $this->generateArray();
        // var_dump($this->options);
        print_r($this);
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