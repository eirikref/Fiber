<?php
/**
 * Fiber: Config
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber;

/**
 * Fiber: Config
 *
 * @package Fiber
 * @version 2013-09-07
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Config
{

    /**
     * Check if passed string is JSON
     *
     * FIXME: This should not really be here (it should not have to),
     * but for now there just isn't a better place for it.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-03
     * @access protected
     * @return boolean
     *
     * @param  string $json JSON data
     */
    protected function isJson($json)
    {
        if (!is_string($json)) {
            return false;
        }

        json_decode($json);
        return (json_last_error() == JSON_ERROR_NONE);
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
        $pattern = "/^([^<]+)(<([^>]+)>)?$/i";

        if (!is_string($config) || strlen($config) > 128) {
            return $data;
        }

        if (strlen($config) > 0 && "!" == $config[0]) {
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
                    $data[$type] = $ret;
                }
            }
        } else {
            $data["value"] = $config;
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

        if (!is_string($opts) || strlen($opts) < 1 || strlen($opts) > 128) {
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
}
