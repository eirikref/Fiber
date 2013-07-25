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
 * @version 2013-07-23
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Fiber extends Base
{

    /**
     * List of registered data types
     *
     * @var    array $types
     * @access private
     */
    private $types = array("array"  => "ArrayType",
                           "bool"   => "Boolean",
                           "object" => "Object");



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
    public function get($config = array())
    {
        $data = array();

        if (is_string($config) && $this->isJson($config)) {
            $config = json_decode($config, true);
        }

        $types = $this->getParamList($config, $this->types);

        foreach ($types as $type) {
            $class      = "\Fiber\\" . $this->types[$type];
            $obj        = new $class();
            $typeConfig = array();

            if (isset($config[$type])) {
                $typeConfig = $config[$type];
            }

            $data[] = $obj->getArray($typeConfig);
        }

        print_r($data);
        $set = call_user_func_array(array($this, "combineParams"), $data);

        return $set;
    }
}
