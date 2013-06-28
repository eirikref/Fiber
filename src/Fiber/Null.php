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
 * @version 2013-06-27
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Null extends DataType
{

    /**
     * Configuration options.
     *
     * @var    array $options
     * @access protected
     */
    protected $options = array("null" => array("active" => true,
                                               "action" => "getNull")
                               );



    /**
     * Get null
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     * @return null
     */
    public function getNull()
    {
        return null;
    }
}
