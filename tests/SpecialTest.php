<?php

class SpecialTest extends PHPUnit_Framework_TestCase
{
    

    /* Depends on erf being present
    public function test_ierf()
    {
        $this->assertTrue(Double.isNaN(ierf(-1.001)));
        $this->assertTrue(Double.isNaN(ierf(1.001)));

        $this->assertTrue(Double.isInfinite(ierf(-1)));
        $this->assertTrue(ierf(-1) < 0);
        $this->assertTrue(Double.isInfinite(ierf(1)));
        $this->assertTrue(ierf(1) > 0);

        for ($x = -5.9; $x < 5.9; $x += 0.01) {
            $y = erf($x);
            $dydx = 2 * exp(-$x * $x) / sqrt(M_PI);
            $this->assertEquals($x, ierf($y), '', 1.0e-15 / $dydx);
        }
    }
    */
}