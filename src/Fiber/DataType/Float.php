<?php
/**
 * Fiber: Float
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber\DataType;

/**
 * Fiber: Float
 *
 * Class for generating integer test data
 *
 * @package Fiber
 * @version 2013-07-18
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Float extends \Fiber\DataType
{

    /**
     * List of available generators for the given data type, with
     * their corresponding action/method
     *
     * @var    array $generators
     * @access protected
     */
    protected $generators = array("zero" => "getZero");



    /**
     * Get zero
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-18
     * @access public
     * @return float
     */
    public function getZero()
    {
        return 0.0;
    }
}
