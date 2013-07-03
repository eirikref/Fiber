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
 * @version 2013-07-03
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

        try {
            $this->validateConfig($input);
            $this->config = $input;
        } catch (\Exception $e) {
            // Do something
            echo "huffda\n";
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
        // return $this->generateArray();
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
