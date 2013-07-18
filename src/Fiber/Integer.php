<?php
/**
 * Fiber: Integer
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber;

/**
 * Fiber: Integer
 *
 * Class for generating integer test data
 *
 * @package Fiber
 * @version 2013-07-18
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Integer extends DataType
{

    /**
     * List of available generators for the given data type, with
     * their corresponding action/method
     *
     * @var    array $generators
     * @access protected
     */
    protected $generators = array("zero"  => "getZero");



    /**
     * Get zero
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-18
     * @access public
     * @return integer
     */
    public function getZero()
    {
        return 0;
    }
}
