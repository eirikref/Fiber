<?php
/**
 * Fiber: Combinable
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Fiber;

/**
 * Fiber: Combinable
 *
 * Abstract superclass for DataType and the top-level Fiber
 *
 * @package Fiber
 * @version 2013-07-24
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
abstract class Combinable
{

    /**
     * Generate all possible unique combinations of the input
     * parameters
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-05
     * @access protected
     * @return array
     */
    protected function combineParams(array $args)
    {
        $data  = array();
        $param = array_shift($args);

        if (sizeof($args) > 0) {
            $rest = $this->combineParams($args);
        }
        
        if (is_array($param) && count($param) > 0) {
            if (isset($rest)) {
                $data = $this->prependArray($rest, $param);
            } else {
                foreach ($param as $p) {
                    $data[] = array($p);
                }
            }
        } elseif (!is_object($param)) {
            if (isset($rest)) {
                $data = $this->prependValue($rest, $param);
            } else {
                $data[] = array($param);
            }
        }

        return $data;
    }



    /**
     * Just a private helper method for $this->combineParams,
     * inserting a given value to the front of every array inside the
     * $list data set.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-12
     * @access private
     * @return void
     *
     * @param  array $list  The list containing the data sets
     * @param  mixed $value The value to prepend to every data set
     */
    private function prependValue(array $list, $value)
    {
        $i = 0;
        foreach ($list as $e) {
            if (is_array($e)) {
                array_unshift($e, $value);
                $list[$i] = $e;
                ++$i;
            }
        }

        return $list;
    }



    /**
     * Just a private helper method for $this->combineParams,
     * inserting values from an array to the front of each element in
     * an already existing data set.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-07-13
     * @access private
     * @return void
     *
     * @param  array $list  The list containing the data sets
     * @param  array $param The array of values
     */
    private function prependArray(array $list, array $param)
    {
        $new = array();

        foreach ($param as $p) {
            foreach ($list as $e) {
                if (is_array($e)) {
                    $tmp = $e;
                    array_unshift($tmp, $p);
                    $new[] = $tmp;
                }
            }
        }

        return $new;
    }



    /**
     * Get generated test data
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-28
     * @access public
     * @return array
     *
     * @param  mixed $config Either an array or JSON
     */
    abstract public function get($config = array());
}
