<?php

class CombinetricsTest extends PHPUnit_Framework_TestCase
{
    public function test_fact()
    {
        $this->assertEquals(1, fact(0));
        $this->assertEquals(1, fact(1));
        $this->assertEquals(2, fact(2));
        $this->assertEquals(120, fact(5));
        $this->assertEquals(3628800, fact(10));
    }

    public function test_npr()
    {
        $this->assertEquals(1, npr(1, 1));
        $this->assertEquals(2, npr(2, 1));
        $this->assertEquals(12, npr(4, 2));
        $this->assertEquals(120, npr(5, 5));
        $this->assertEquals(6720, npr(8, 5));
    }
    
    public function test_ncr()
    {
        $this->assertEquals(1, ncr(1, 1));
        $this->assertEquals(2, ncr(2, 1));
        $this->assertEquals(6, ncr(4, 2));
        $this->assertEquals(1, ncr(5, 5));
        $this->assertEquals(56, ncr(8, 5));
    }
}