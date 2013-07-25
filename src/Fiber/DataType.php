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
 * @version 2013-07-22
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
abstract class DataType extends Base
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
            $generators = $this->getParamList($config, $this->generators);
        
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
