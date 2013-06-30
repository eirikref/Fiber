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
 * @version 2013-06-28
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
abstract class DataType
{
    
    /**
     * Options for the data this datatype will generate. Meant to be
     * populated inside each subclass as configuration with defaults,
     * and possible to enable/disble either through the constructor or
     * setOptions().
     *
     * @var    array $options
     * @access protected
     */
    protected $options = array();

    /**
     * Data structure used for storing optional list of parameters in
     * the arrays we will generate. Ie. when we want a set of items
     * like 'array("test.test", <generated data>)', where "test.test"
     * is the same for all items, but <generated data> varies from
     * item to item and contains the set of strings, ints, floats,
     * etc. that we generate.
     *
     * FIXME: Currently the parameter "__GEN__" as a placeholder for
     * the automatically generated entry, which is just a temporary
     * hack. I guess.
     *
     * @var    array $params
     * @access private
     */
    protected $params = array();



    /**
     * Constructor
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     *
     * @param  array $options Run-time settings
     */
    public function __construct(array $options = null)
    {
        if (isset($options)) {
            $this->setOptions($options);
        }
    }



    /**
     * Set options
     *
     * Parse run-time options and update $this->options. The reserved
     * key "params" is used for passing configuration regarding the
     * list of array parameters.
     *
     * FIXME: Just setting $options[$key] to $value is not really
     * robust, is it? If I end up exposing this to end-users, the
     * potential for errors is huge.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     * @return void
     *
     * @param  array $options Run-time settings
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            if (isset($this->options[$key])) {
                $this->options[$key] = $value;
            } elseif ("params" == $key) {
                $this->params = $value;
            }
        }
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
        return $this->generateArray();
    }



    /**
     * Generate the array to be returned
     *
     * Generic generator of the data we want to return.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     * @return array
     */
    public function generateArray()
    {
        $data         = array();
        $i            = 0;
        $actionMaxLen = 32;

        foreach ($this->options as $key => $opt) {
            if (!isset($opt["active"]) || true !== $opt["active"]) {
                continue;
            }

            if (!isset($opt["action"]) || !is_string($opt["action"]) ||
                strlen($opt["action"]) < 1 ||
                strlen($opt["action"]) > $actionMaxLen) {
                continue;
            }

            $call = $opt["action"];
            if (!method_exists($this, $call)) {
                continue;
            }

            $ret = $this->{$call}();
            
            if (count($this->params) > 0) {
                foreach ($this->params as $val) {
                    if ("__GEN__" == $val) {
                        $data[$i][] = $ret;
                    } else {
                        $data[$i][] = $val;
                    }
                }
            } else {
                $data[$i][] = $ret;
            }
            ++$i;
        }

        return $data;
    }
}
