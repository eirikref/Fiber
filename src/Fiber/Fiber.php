<?php

/**
 * Fiber: Fiber
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber;

/**
 * Fiber: Fiber
 *
 * Main class used for generating data of multiple data types
 *
 * @package Fiber
 * @version 2013-08-20
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Fiber
{



    /**
     * Generate all possible unique combinations of the input
     * parameters
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-05
     * @access protected
     * @return array
     */
    protected function combineParams(array $args)
    {
        $data  = array();
        $param = array_shift($args);

        if (sizeof($args) > 0) {
            $rest = $this->combineParams($args);
        }
        
        if (is_array($param) && count($param) > 0) {
            if (isset($rest)) {
                $data = $this->prependArray($rest, $param);
            } else {
                foreach ($param as $p) {
                    $data[] = array($p);
                }
            }
        } elseif (!is_object($param)) {
            if (isset($rest)) {
                $data = $this->prependValue($rest, $param);
            } else {
                $data[] = array($param);
            }
        }

        return $data;
    }



    /**
     * Just a private helper method for $this->combineParams,
     * inserting a given value to the front of every array inside the
     * $list data set.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-12
     * @access private
     * @return void
     *
     * @param  array $list  The list containing the data sets
     * @param  mixed $value The value to prepend to every data set
     */
    private function prependValue(array $list, $value)
    {
        $i = 0;
        foreach ($list as $e) {
            if (is_array($e)) {
                array_unshift($e, $value);
                $list[$i] = $e;
                ++$i;
            }
        }

        return $list;
    }



    /**
     * Just a private helper method for $this->combineParams,
     * inserting values from an array to the front of each element in
     * an already existing data set.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-13
     * @access private
     * @return void
     *
     * @param  array $list  The list containing the data sets
     * @param  array $param The array of values
     */
    private function prependArray(array $list, array $param)
    {
        $new = array();

        foreach ($param as $p) {
            foreach ($list as $e) {
                if (is_array($e)) {
                    $tmp = $e;
                    array_unshift($tmp, $p);
                    $new[] = $tmp;
                }
            }
        }

        return $new;
    }



    /**
     * List of registered data types
     *
     * @var    array $types
     * @access private
     */
    /* private $types = array("array"  => "ArrayType", */
    /*                        "bool"   => "Boolean", */
    /*                        "object" => "Object", */
    /*                        "string" => "String"); */



    /**
     * Helper method for getting list of registered data types
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-18
     * @access public
     * @return array
     */
    /* public function getTypes() */
    /* { */
    /*     return $this->types; */
    /* } */



    /**
     * Get data sets
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-19
     * @access public
     * @return array
     */
    public function get()
    {
        /* $args = func_get_args(); */
        /* $data = array(); */
        
        /* if (count($args) < 1) { */
        /*     return null; */
        /* } */

        /* foreach ($args as $config) { */
        /*     $subset = array(); */
        /*     if (is_string($config) && $this->isJson($config)) { */
        /*         $config = json_decode($config, true); */
        /*     } elseif (is_string($config)) { */
        /*         $config = $this->parseCompactConfig($config); */
        /*     } */
            
        /*     if (is_array($config) && $this->validateConfig($config)) { */
        /*         if (isset($config["value"])) { */
        /*             $subset[] = $config["value"]; */
        /*         } else { */
        /*             $types = $this->getParamList($config, $this->types); */
                    
        /*             foreach ($types as $type) { */
        /*                 $class      = "\Fiber\\" . $this->types[$type]; */
        /*                 $obj        = new $class(); */
        /*                 $typeConfig = array(); */
                        
        /*                 // FIXME: Need error handling here if it is NOT an */
        /*                 // array, which means that the user supplied config is */
        /*                 // wrong and we should not just swallow the error and */
        /*                 // move on without notifying the end-user */
        /*                 if (isset($config[$type]) && is_array($config[$type])) { */
        /*                     $typeConfig = $config[$type]; */
        /*                 } */
                        
        /*                 $subset[] = $obj->getArray($typeConfig); */
        /*             } */
        /*         } */
        /*     } */

        /*     if (count($subset) > 0) { */
        /*         $data[] = $this->flattenSet($subset); */
        /*     } */
        /* } */

        /* if (count($data) > 1) { */
        /*     return $this->combineParams($data); */
        /* } elseif (1 == count($data)) { */
        /*     $arr = array(); */
        /*     foreach ($data[0] as $d) { */
        /*         $arr[] = array($d); */
        /*     } */
        /*     return $arr; */
        /* } else { */
        /*     return null; */
        /* } */
    }



    /**
     * Flatten set
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-19
     * @access private
     * @return array
     *
     * @param  array $in
     */
    private function flattenSet(array $in)
    {
        /* $out = array(); */

        /* foreach ($in as $val) { */
        /*     if (is_array($val)) { */
        /*         foreach ($val as $b) { */
        /*             $out[] = $b; */
        /*         } */
        /*     } else { */
        /*         $out[] = $val; */
        /*     } */
        /* } */

        /* return $out; */
    }
}
