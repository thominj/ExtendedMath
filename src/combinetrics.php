<?php

if (!function_exists('fact')) {
    /**
     * fact
     * 
     * Returns the factorial of an integer.
     * 
     * @param int $x 
     * @return int The factorial of $x, i.e. x!
     */
    function fact($x) {
        if ($x < 0) {
            throw new InvalidArgumentException("fact() only takes non-negative integers, $x provided.");
        }
        
        $x = floor($x);
        
        $sum = 1;
        
        for ($i = 1; $i <= $x; $i++) {
            $sum *= $i;
        }
        
        return $sum;
    }
}

if (!function_exists('npr')) {
    /**
     * npr
     * 
     * Permutation function. Returns the number of ways of choosing $r objects
     * from a collection of $n objects, where the order of selection matters.
     * 
     * @param int $n The size of the collection
     * @param int $r The size of the selection
     * @return int $n pick $r
     * @static
     */
    function npr($n, $r) {
        return fact($n) / fact($n - $r);
    }
}

if (!function_exists('ncr')) {
    /**
     * ncr
     * 
     * Combination function Returns the number of ways of choosing $r objects
     * from a collection of $n objects, where the order of selection does not
     * matter.
     * 
     * @param int $n The size of the collection
     * @param int $r The size of the selection
     * @return int $n choose $r
     * @static
     */
    function ncr($n, $r) {
        return npr($n, $r) / fact($r);
    }
}