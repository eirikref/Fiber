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
 * @version 2013-07-20
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
abstract class DataType
{
    
    /**
     * List of available generators for the given data type, with
     * their corresponding action/method
     *
     * @var    array $generators
     * @access protected
     */
    protected $generators = array();



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
        return true;
    }



    /**
     * Get generated test data
     *
     * Default implementation. Override in subclasses as necessary.
     *
     * How things work around here: The user is supposed to call
     * $fiber->get(), $array->get(), etc. and get back a complete data
     * set that is ready for use in PHPUnit as a standard data
     * provider array.
     *
     * Internally we're going to call getArray(), which will make an
     * array with all the possible, different values. Then we'll merge
     * it here in get(). So ie. if the user calls String::get()
     * directly, we'll call getArray(), package the array nicely below
     * and return it.
     *
     * If the user calls Fiber::get(), we'll call getArray() for all
     * the different types of data to be included, and then merge it
     * all in Fiber::get(). Or something like that.
     *
     * $config needs to be either a PHP array or a JSON array, as
     * defined by the format found at
     * https://github.com/eirikref/Fiber/blob/master/design/configuration-format.md
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-28
     * @access public
     * @return array
     *
     * @param  mixed $config Either an array or JSON
     */
    public function get($config = array())
    {
        $set = array();

        if (is_string($config) && $this->isJson($config)) {
            $config = json_decode($config, true);
        }

        if (is_array($config) && $this->validateConfig($config)) {
            $array = $this->getArray($config);
            $set   = $this->combineParams($array);
        } else {
            // Do some sort of error logging
        }

        return $set;
    }


    
    /**
     * Generate the raw array of values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-05
     * @access public
     * @return array
     */
    public function getArray()
    {
        $data = array();

        foreach ($this->generators as $key => $method) {
            if (method_exists($this, $method)) {
                $data[] = $this->{$method}();
            }
        }

        return $data;
    }
}
