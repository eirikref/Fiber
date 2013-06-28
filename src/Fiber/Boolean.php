<?php
/**
 * Fiber: Boolean
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber;

/**
 * Fiber: Boolean
 *
 * Class for generating boolean test data
 *
 * @package Fiber
 * @version 2013-06-27
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Boolean extends DataType
{
    
    /**
     * Configuration options.
     *
     * @var    array $options
     * @access protected
     */
    protected $options = array("true"  => array("active" => true,
                                                "action" => "getTrue"),
                               "false" => array("active" => true,
                                                "action" => "getFalse")
                               );



    /**
     * Get boolean true
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     * @return boolean
     */
    public function getTrue()
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
    public function getFalse()
    {
        return false;
    }
}
