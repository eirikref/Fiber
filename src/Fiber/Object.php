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
 * @version 2013-07-05
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Object extends \Fiber\DataType
{

    /**
     * Configuration options
     *
     * @var    array $options
     * @access protected
     */
    protected $options = array("object" => array("active" => true,
                                                 "action" => "getObject")
                               );



    /**
     * Get object
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     * @return object
     */
    public function getObject()
    {
        return new \stdClass();
    }
}
