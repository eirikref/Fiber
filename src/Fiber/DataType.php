<?php
/**
 * Fiber: DataType
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber;

/**
 * Fiber: DataType
 *
 * Base class for all the different available data types
 *
 * @package Fiber
 * @version 2013-07-11
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
abstract class DataType
{
    
    /**
     * User supplied configuration with parameters for generating test
     * data
     *
     * @var    array $config
     * @access protected
     */
    protected $config = array();

    /**
     * List of available generators for the given data type, with
     * their corresponding action/method
     *
     * @var    array $generators
     * @access protected
     */
    protected $generators = array();



    /**
     * Constructor
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     *
     * @param  mixed $config Generator configuration
     */
    public function __construct($config = null)
    {
        if (isset($config)) {
            $this->setConfig($config);
        }
    }



    /**
     * Set configuration
     *
     * Set configuration for the data generator. $config needs to be
     * either a PHP array or a JSON array, as defined by the format
     * found at
     * https://github.com/eirikref/Fiber/blob/master/design/configuration-format.md
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     * @return void
     *
     * @param  mixed $config Generator config
     */
    public function setConfig($input)
    {
        if ($this->isJson($input)) {
            $input = json_decode($input, true);
        }

        if ($this->validateConfig($input)) {
            $this->config = $input;
        } else {
            // Do something
        }
    }



    /**
     * Check if passed string is JSON
     *
     * FIXME: This should not really be here (it should not have to),
     * but for now there just isn't a better place for it.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-03
     * @access private
     * @return boolean
     *
     * @param  string $json JSON data
     */
    private function isJson($json)
    {
        if (!is_string($json)) {
            return false;
        }

        json_decode($json);
        return (json_last_error() == JSON_ERROR_NONE);
    }



    /**
     * Generate all possible unique combinations of the input
     * parameters
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-05
     * @access private
     * @return array
     */
    private function combineParams()
    {
        $args = func_get_args();
        $num  = func_num_args();
        $data = array();

        // print_r($args);

        if (0 == $num) {
            return;
        }

        $param = array_shift($args);
        if (sizeof($args) > 0) {
            $rest = $this->combineParams($args);
        }
        
        if (is_array($param)) {
            foreach ($param as $el) {
                if (isset($rest)) {
                    $this->prependList($rest, $el);
                } else {
                    $data[] = array($el);
                }
            }
        } elseif (!is_object($param)) {
            if (isset($rest)) {
                $this->prependList($rest, $param);
            } else {
                $data[] = array($param);
            }
        }

        return $data;
    }



    /**
     * Just a private helper method for $this->combineParams,
     * inserting a given element to the front of every array inside
     * the $list data set.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-12
     * @access private
     * @return void
     *
     * @param  array $list The list containing the data sets
     * @param  mixed $item The item to append to every data set
     */
    private function prependList(array $list, $item)
    {
        foreach ($list as $e) {
            array_unshift($e, $item);
        }
    }


    /**
     * Validate configuration array
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-03
     * @access private
     * @return boolean
     *
     * @param  array $config Configuration data
     */
    private function validateConfig(array $config)
    {
        // Implement me
        return true;
    }



    /**
     * Get generated test data
     *
     * Default implementation. Override in subclasses as necessary.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-28
     * @access public
     * @return array
     */
    public function get()
    {
        return $this->generateDataSet();
    }



    /**
     * Generate the data set
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-05
     * @access private
     * @return array
     */
    private function generateDataSet()
    {
        // Option 1: Only allow single items for DataType::get(), but
        // provide a super easy way of aking combination.
        // String::get(...), String::get(...)

        foreach ($this->generators as $name => $method) {
            // 1. Check in config if:
            //    - we're in include mode and this genrator IS included
            //    - or if we're in exclude and this generator is NOT excluded
            // 2. 
        }
    }



    /**
     * Generate the array to be returned
     *
     * Generic generator of the data we want to return.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access private
     * @return array
     */
    // private function generateArray()
    // {
    //     $data = array();
    //     $i    = 0;

    //     foreach ($this->options as $key => $opt) {
    //         if (!$this->validateItem($opt)) {
    //             continue;
    //         }

    //         $call = $opt["action"];
    //         $ret  = $this->{$call}();
            
    //         if (count($this->params) > 0) {
    //             foreach ($this->params as $val) {
    //                 if ("__GEN__" == $val) {
    //                     $data[$i][] = $ret;
    //                 } else {
    //                     $data[$i][] = $val;
    //                 }
    //             }
    //         } else {
    //             $data[$i][] = $ret;
    //         }
    //         ++$i;
    //     }

    //     return $data;
    // }



    /**
     * Validate options entry
     *
     * Validate a single item in the $this->options array
     *
     * FIXME: Refactor to have better error handling, with finer
     * granularity
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-30
     * @access private
     * @return boolean
     *
     * @param  array $item
     */
    // private function validateItem(array $item)
    // {
    //     $maxLen = 32;

    //     if (!isset($item["active"]) || true !== $item["active"]) {
    //         return false;
    //     }
        
    //     if (!isset($item["action"]) || !is_string($item["action"]) ||
    //         strlen($item["action"]) < 1 ||
    //         strlen($item["action"]) > $maxLen) {
    //         return false;
    //     }
        
    //     if (!method_exists($this, $item["action"])) {
    //         return false;
    //     }

    //     return true;
    // }
}
