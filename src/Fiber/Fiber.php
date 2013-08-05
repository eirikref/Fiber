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
 * @version 2013-08-05
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
     * Check if passed string is in the compact config format
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-05
     * @access protected
     * @return array
     *
     * @param  string $config The config string
     */
    protected function parseCompactConfig($config)
    {
        $data    = array();
        $include = true;
        $pattern = "/^([^<]+)$/i";

        if (strlen($config) < 1 || strlen($config) > 128) {
            return $data;
        }

        if ("!" == $config[0]) {
            $include = false;
            $config  = ltrim($config, "!");
        }

        preg_match($pattern, $config, $matches);
        if (!isset($matches[1]) || !isset($this->types[$matches[1]])) {
            return $data;
        }

        if (true === $include) {
            $data["include"] = $matches[0];
        } else {
            $data["exclude"] = $matches[0];
        }

        return $data;
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
        } elseif (is_string($config)) {
            $config = $this->parseCompactConfig($config);
        }

        if (is_array($config) && $this->validateConfig($config)) {
            $types = $this->getParamList($config, $this->types);
            
            foreach ($types as $type) {
                $class      = "\Fiber\\" . $this->types[$type];
                $obj        = new $class();
                $typeConfig = array();
                
                // FIXME: Need error handling here if it is NOT an
                // array, which means that the user supplied config is
                // wrong and we should not just swallow the error and
                // move on without notifying the end-user
                if (isset($config[$type]) && is_array($config[$type])) {
                    $typeConfig = $config[$type];
                }
                
                $data[] = $obj->getArray($typeConfig);
            }
            
            $set = $this->combineParams($data);
            return $set;
        }

        return null;
    }
}
