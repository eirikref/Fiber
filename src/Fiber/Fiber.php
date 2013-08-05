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
     * The compact format typically looks like: string<1-32, utf-8>,
     * !bool, or maybe !int<200-300>
     *
     * 1. If ! is the first character, jump into exclude mode
     * 2. Then try to find a string (anything but a <) which matches a
     *    registered data type
     * 3. Then look for options inside <>
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-05
     * @access private
     * @return array
     *
     * @param  string $config The config string
     */
    private function parseCompactConfig($config)
    {
        $data    = array();
        $type    = null;
        $opts    = null;
        $include = true;
        $pattern = "/^([^<]+(<([^>]+)>)?)$/i";

        if (strlen($config) < 1 || strlen($config) > 128) {
            return $data;
        }

        if ("!" == $config[0]) {
            $include = false;
            $config  = ltrim($config, "!");
        }

        preg_match($pattern, $config, $matches);

        if (isset($matches[1])) {
            $type = $matches[1];
        }

        if (isset($matches[3])) {
            $opts = $matches[3];
        }

        if (isset($this->types[$type])) {
            if (true === $include) {
                $data["include"] = $type;
            } else {
                $data["exclude"] = $type;
            }

            if (isset($opts)) {
                $ret = $this->parseCompactOptions($opts);
                if (array($ret)) {
                    $data[$type] = $opts;
                }
            }
        }

        return $data;
    }



    /**
     * Parse compact config format options
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-08-05
     * @access private
     * @return mixed Usually an array, void on errors
     */
    private function parseCompactOptions($opts)
    {
        $data           = array();
        $rangePattern   = "/^([0-9]+)-([0-9]+)$/";
        $charsetPattern = "/^(utf8|latin1)$/";

        if (strlen($opts) < 1 || strlen($opts) > 128) {
            return;
        }

        $params = explode(":", $opts);
        foreach ($params as $p) {
            if (preg_match($rangePattern, $p, $rangeMatches)) {
                $data["min"] = (int)$rangeMatches[1];
                $data["max"] = (int)$rangeMatches[2];
            } elseif (preg_match($charsetPattern, $p, $charsetMatches)) {
                $data["charset"] = $p;
            }
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
