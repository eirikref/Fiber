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
 * @version 2013-08-21
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
     * Data type specific config
     *
     * @var    array $config
     * @access protected
     */
    protected $config = array();



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
     * Parse list of generators found in config
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-22
     * @access protected
     * @return array
     *
     * @param  string $configList
     */
    protected function parseConfigList($configList)
    {
        $ret  = array();

        if (is_string($configList) && strlen($configList) > 0) {
            $list = explode(",", $configList);

            foreach ($list as $val) {
                $ret[] = trim($val);
            }
        }

        return $ret;
    }



    /**
     * Get list of valid parameters (generators or data types) for a
     * given request
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-22
     * @access protected
     * @return array
     *
     * @param  array $config
     * @param  array $valid
     */
    protected function getParamList(array $config, array $valid)
    {
        $ret = array();

        if (isset($config["include"])) {
            $include = $this->parseConfigList($config["include"]);

            foreach ($include as $gen) {
                if (isset($valid[$gen])) {
                    $ret[] = $gen;
                }
            }
        } elseif (isset($config["exclude"])) {
            $res     = $this->parseConfigList($config["exclude"]);
            $exclude = array_flip($res);
            
            foreach ($valid as $gen => $method) {
                if (!isset($exclude[$gen])) {
                    $ret[] = $gen;
                }
            }
        } else {
            $ret = array_keys($valid);
        }

        return $ret;
    }



    /**
     * Validate configuration array
     *
     * FIXME: Should have some sort of proper error logging and
     * handling instead of just returning false
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-23
     * @access protected
     * @return boolean
     *
     * @param  array $config Configuration data
     */
    protected function validateConfig(array $config)
    {
        if (0 == count($config)) {
            return true;
        }

        if (isset($config["include"]) && isset($config["exclude"])) {
            return false;
        }

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

        if (is_array($config)) {
            $raw = $this->getArray($config);
            if (is_array($raw) && count($raw) > 0) {
                $set = $this->combineParams($raw);
                return $set;
            }
        }
  
        return null;
    }


    
    /**
     * Generate the raw array of values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-05
     * @access public
     * @return array
     *
     * @param  array $config
     */
    public function getArray(array $config)
    {
        $data = array();

        if ($this->validateConfig($config)) {
            $generators   = $this->getParamList($config, $this->generators);
            $this->config = $config;
        
            foreach ($generators as $g) {
                $method = $this->generators[$g];
                
                if (method_exists($this, $method)) {
                    $data[] = $this->{$method}();
                }
            }
        }

        return $data;
    }
}
