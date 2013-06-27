<?php

namespace Fiber;

abstract class DataType
{
    
    private $options = array();
    private $params = array();


    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }


    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            if (isset($this->options[$key])) {
                $this->options[$key] = $value;
            } elseif ("params" == $key) {
                $this->params = $value;
            }
        }
    }



    public function generateArray()
    {
        $data = array();
        $i    = 0;

        foreach ($this->options as $key => $opt) {
            echo "fisk";
            if (true === $opt["active"] && isset($opt["action"])) {
                $call = $opt["action"];
                if (method_exists($this, $call)) {
                    $ret = $this->{$call}();

                    if (count($this->params) > 0) {
                        foreach ($this->params as $val) {
                            if ("__GEN__" == $val) {
                                $data[$i][] = $ret;
                            } else {
                                $data[$i][] = $val;
                            }
                        }
                    } else {
                        $data[$i] = $ret;
                    }
                }
            }
            ++$i;
        }

        return $data;
    }

    
}