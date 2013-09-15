<?php
/**
 * Fiber: Boolean
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\DataType;

/**
 * Fiber: Boolean
 *
 * Class for generating boolean test data
 *
 * @package Fiber
 * @version 2013-07-17
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Boolean extends \Fiber\DataType
{
    
    /**
     * List of available generators for the given data type, with
     * their corresponding action/method
     *
     * @var    array $generators
     * @access protected
     */
    protected $generators = array("true"  => "getTrue",
                                  "false" => "getFalse");



    /**
     * Get boolean true
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     * @return boolean
     */
    public static function getTrue()
    {
        return true;
    }



    /**
     * Get boolean false
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     * @return boolean
     */
    public static function getFalse()
    {
        return false;
    }
}
