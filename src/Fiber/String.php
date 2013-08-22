<?php
/**
 * Fiber: String
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber;

/**
 * Fiber: String
 *
 * Class for generating string test data
 *
 * Things: - strings of various length (min, max, exact)
 *         - different charsets
 *         - empty strings (just length 0)
 *         - really long strings (1M, 5M, 10M, etc.)
 *         - single string, words, sentences, lorem ipsum, special chars
 *           (!?;:, etc.), password (fix of small, caps, numbers,
 *           etc.)
 *
 *          - UTF-8, UTF with bad enconding, UTF-8 bad declaration, UTF-8
 *            with chars that are invalid in XML.
 *
 * @package Fiber
 * @version 2013-08-22
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class String extends DataType
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
     * Generate string
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access public
     * @return string
     */
    public function generateString($length)
    {
        $ret = "";

        if (!is_int($length) || $length < 1) {
            return $ret;
        }

        for ($i = 0; $i < $length; ++$i) {
            $val  = rand(32, 126);
            $char = chr($val);
            
            $ret .= $char;
        }

        return $ret;
    }



    /**
     * Get object
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-18
     * @access public
     * @return string
     */
    public function getEmpty()
    {
        return "";
    }
}
