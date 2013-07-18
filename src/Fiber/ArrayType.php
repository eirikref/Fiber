<?php
/**
 * Fiber: Array
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber;

/**
 * Fiber: Array
 *
 * Class for generating array test data
 *
 * @package Fiber
 * @version 2013-07-15
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class ArrayType extends DataType
{
    
    /**
     * List of available generators for the given data type, with
     * their corresponding action/method
     *
     * @var    array $generators
     * @access protected
     */
    protected $generators = array("empty" => "getEmpty");



    /**
     * Get an empty array
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-15
     * @access public
     * @return array
     *
     * @param  mixed $config Generator configuration
     */
    public static function getEmpty()
    {
        return array();
    }
}
