<?php

namespace Fiber;

class Object extends DataType
{
    
    public function getObject()
    {
        return new StdClass();
    }
}