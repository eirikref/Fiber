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
 * @package Fiber
 * @version 2013-06-27
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class String extends DataType
{

    /**
     * Get object
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-27
     * @access private
     * @return object
     */
    private function generateString($length, $charset, $mode)
    {
    }



    /**
     * Get object
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-18
     * @access public
     * @return object
     */
    public function getEmpty()
    {
        return "";
    }
}
