<?php
/**
 * Fiber: Null
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber;

/**
 * Fiber: Null
 *
 * Class for generating null test data
 *
 * @package Fiber
 * @version 2013-07-18
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Null extends DataType
{
    
    /**
     * List of available generators for the given data type, with
     * their corresponding action/method
     *
     * @var    array $generators
     * @access protected
     */
    protected $generators = array("null"  => "getNull");



    /**
     * Get null
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     * @return null
     */
    public static function getNull()
    {
        return null;
    }
}
