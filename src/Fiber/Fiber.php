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
 * @version 2013-07-16
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Fiber extends \Fiber\DataType
{

    /**
     * List of registered data types
     *
     * @var    array $types
     * @access private
     */
    private $types = array("ArrayType");



    /**
     * Generate complete data set for all types
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-16
     * @access public
     * @return array
     */
    public function generateDataSet()
    {
    }

    
}
