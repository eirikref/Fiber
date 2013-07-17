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
 * @version 2013-07-16
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
    private function combineParams(array $args)
    {
        $data  = array();
        $param = array_shift($args);

        if (sizeof($args) > 0) {
            $rest = $this->combineParams($args);
        }
        
        if (is_array($param)) {
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
    public function get($config = null)
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
        // provide a super easy way of making combinations.
        // String::get(...), String::get(...)
        $data = array();

        foreach ($this->generators as $name => $method) {
            if (method_exists($this, $method)) {
                $data[] = $this->{$method}();
            }
            // 1. Check in config if:
            //    - we're in include mode and this generator IS included
            //    - or if we're in exclude and this generator is NOT excluded
            // 2. 
        }

        return $data;
    }
}
