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
 * @version 2013-07-20
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Fiber extends DataType
{

    /**
     * List of registered data types
     *
     * @var    array $types
     * @access private
     */
    private $types = array("ArrayType");



    /**
     * Helper method for getting list of registered data types
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-18
     * @access public
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }



    /**
     * Get data sets
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-19
     * @access public
     * @return array
     */
    public function get($config = null)
    {
        $data = array();

        foreach ($this->getTypes() as $type) {
            $class  = "\Fiber\\$type";
            $obj    = new $class();
            $data[] = $obj->getArray(array());
        }

        $set = call_user_func_array(array($this, "combineParams"), $data);
        return $set;
    }
}
