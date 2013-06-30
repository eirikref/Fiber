<?php

namespace Fiber\Tests\DataType;

class GenerateArrayTest extends \PHPUnit_Framework_TestCase
{
    
    public function testConstructor()
    {
        $gen = $this->getMockForAbstractClass("\Fiber\DataType");
        $ref = new \ReflectionProperty($gen, "options");
        $ref->setAccessible(true);
        $ref->setValue($gen, array("fisk"));
        // print_r($gen);

        $gen->get();
    }
}
