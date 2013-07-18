<?php
/**
 * Fiber: Object
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber;

/**
 * Fiber: Object
 *
 * Class for generating object test data
 *
 * @package Fiber
 * @version 2013-07-18
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Object extends \Fiber\DataType
{

    /**
     * List of available generators for the given data type, with
     * their corresponding action/method
     *
     * @var    array $generators
     * @access protected
     */
    protected $generators = array("stdclass"  => "getStdClass");



    /**
     * Get object
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     * @return object
     */
    public static function getStdClass()
    {
        return new \stdClass();
    }
}
