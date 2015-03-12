<?php

if (!function_exists('lanczos')) {
    /**
     * lanczos
     * 
     * Returns the Lanczos approximation used to compute the gamma function.
     * The Lanczos approximation is related to the Gamma function by the
     * following equation:
     * 
     * gamma(x) = sqrt(2 * pi) / x * (x + g + 0.5) ^ (x + 0.5)
     *                   * exp(-x - g - 0.5) * lanczos(x)
     * 
     * where `g` is the Lanczos constant.
     *
     * @param float $x
     * @return float
     */
    function lanczos($x)
    {
        $LANCZOS = [
            0.99999999999999709182,
            57.156235665862923517,
            -59.597960355475491248,
            14.136097974741747174,
            -0.49191381609762019978,
            .33994649984811888699e-4,
            .46523628927048575665e-4,
            -.98374475304879564677e-4,
            .15808870322491248884e-3,
            -.21026444172410488319e-3,
            .21743961811521264320e-3,
            -.16431810653676389022e-3,
            .84418223983852743293e-4,
            -.26190838401581408670e-4,
            .36899182659531622704e-5,
        ];
        
        $sum = 0.0;
        
        for ($i = count($LANCZOS) - 1; $i > 0; --$i) {
            $sum += $LANCZOS[$i] / ($x + $i);
        }
        
        return $sum + $LANCZOS[0];
    }
}

if (!function_exists('invGamma1pm1')) {
    /**
     * invGamma1pm1
     * 
     * Returns the value of 1 / gamma(1 + x) - 1 for -0.5 <= x <=
     * 1.5. This implementation is based on the double precision
     * implementation in the NSWC Library of Mathematics Subroutines.
     *
     * @param float $x
     * @return float 1.0 / Gamma(1.0 + x) - 1.0
     * @throws InvalidArgumentException if $x < -0.5
     * @throws InvalidArgumentException if $x > 1.5
     */
    function invGamma1pm1($x)
    {
        if ($x < -0.5) {
            throw new InvalidArgumentException("Value $x too small.");
        }
        
        if ($x > 1.5) {
            throw new  InvalidArgumentException("Value $x too large.");
        }

        $t = $x <= 0.5 ? $x : ($x - 0.5) - 0.5;
        
        if ($t < 0.0) {
            $a =  .611609510448141581788E-08 + $t * .624730830116465516210E-08;
            $b =  .195755836614639731882E-09;
            $b = -.607761895722825260739E-07 + $t * $b;
            $b =  .992641840672773722196E-06 + $t * $b;
            $b = -.643045481779353022248E-05 + $t * $b;
            $b = -.851419432440314906588E-05 + $t * $b;
            $b =  .493944979382446875238E-03 + $t * $b;
            $b =  .266205348428949217746E-01 + $t * $b;
            $b =  .203610414066806987300E+00 + $t * $b;
            $b = 1.0 + $t * $b;

            $c = -.205633841697760710345015413002057E-06 + $t * ($a / $b);
            $c =  .113302723198169588237412962033074E-05 + $t * $c;
            $c = -.125049348214267065734535947383309E-05 + $t * $c;
            $c = -.201348547807882386556893914210218E-04 + $t * $c;
            $c =  .128050282388116186153198626328164E-03 + $t * $c;
            $c = -.215241674114950972815729963053648E-03 + $t * $c;
            $c = -.116516759185906511211397108401839E-02 + $t * $c;
            $c =  .721894324666309954239501034044657E-02 + $t * $c;
            $c = -.962197152787697356211492167234820E-02 + $t * $c;
            $c = -.421977345555443367482083012891874E-01 + $t * $c;
            $c =  .166538611382291489501700795102105E+00 + $t * $c;
            $c = -.420026350340952355290039348754298E-01 + $t * $c;
            $c = -.655878071520253881077019515145390E+00 + $t * $c;
            $c = -.422784335098467139393487909917598E+00 + $t * $c;
            
            if ($x > 0.5) {
                $ret = $t * $c / $x;
            } else {
                $ret = $x * (($c + 0.5) + 0.5);
            }
        } else {
            $p =  .4343529937408594255178E-14;
            $p = -.1249441572276366213222E-12 + $t * $p;
            $p =  .1572833027710446286995E-11 + $t * $p;
            $p =  .4686843322948848031080E-1  + $t * $p;
            $p =  .6820161668496170657918E-09 + $t * $p;
            $p =  .6871674113067198736152E-08 + $t * $p;
            $p =  .6116095104481415817861E-08 + $t * $p;

            $q =  .2692369466186361192876E-03;
            $q =  .4956830093825887312020E-02 + $t * $q;
            $q =  .5464213086042296536016E-01 + $t * $q;
            $q =  .3056961078365221025009E+00 + $t * $q;
            $q = 1.0 + $t * $q;

            $c = -.205633841697760710345015413002057E-06 + ($p / $q) * $t;
            $c =  .113302723198169588237412962033074E-05 + $t * $c;
            $c = -.125049348214267065734535947383309E-05 + $t * $c;
            $c = -.201348547807882386556893914210218E-04 + $t * $c;
            $c =  .128050282388116186153198626328164E-03 + $t * $c;
            $c = -.215241674114950972815729963053648E-03 + $t * $c;
            $c = -.116516759185906511211397108401839E-02 + $t * $c;
            $c =  .721894324666309954239501034044657E-02 + $t * $c;
            $c = -.962197152787697356211492167234820E-02 + $t * $c;
            $c = -.421977345555443367482083012891874E-01 + $t * $c;
            $c =  .166538611382291489501700795102105E+00 + $t * $c;
            $c = -.420026350340952355290039348754298E-01 + $t * $c;
            $c = -.655878071520253881077019515145390E+00 + $t * $c;
            $c =  .577215664901532860606512090082402E+00 + $t * $c;

            if ($x > 0.5) {
                $ret = ($t / $x) * (($c - 0.5) - 0.5);
            } else {
                $ret = $x * $c;
            }
        }

        return $ret;
    }
}

if (!function_exists('gamma')) {
    /**
     * gamma
     * 
     * Returns the value of gamma(x). Based on the NSWC Library of
     * Mathematics Subroutines double precision implementation.
     *
     * @param float $x
     * @return
     */
    function gamma($x) {
        if ($x == round($x) && $x <= 0.0) {
            return NAN;
        }

        $absX = abs($x);
        
        if ($absX <= 20.0) {
            if ($x >= 1.0) {
                /*
                 * From the recurrence relation
                 * Gamma(x) = (x - 1) * ... * (x - n) * Gamma(x - n),
                 * then
                 * Gamma(t) = 1 / [1 + invGamma1pm1(t - 1)],
                 * where t = x - n. This means that t must satisfy
                 * -0.5 <= t - 1 <= 1.5.
                 */
                $prod = 1.0;
                $t = $x;
                
                while ($t > 2.5) {
                    $t -= 1.0;
                    $prod *= $t;
                }
                
                $ret = $prod / (1.0 + invGamma1pm1($t - 1.0));
            } else {
                /*
                 * From the recurrence relation
                 * Gamma(x) = Gamma(x + n + 1) / [x * (x + 1) * ... * (x + n)]
                 * then
                 * Gamma(x + n + 1) = 1 / [1 + invGamma1pm1(x + n)],
                 * which requires -0.5 <= x + n <= 1.5.
                 */
                $prod = $x;
                $t = $x;
                
                while ($t < -0.5) {
                    $t += 1.0;
                    $prod *= $t;
                }
                
                $ret = 1.0 / ($prod * (1.0 + invGamma1pm1($t)));
            }
        } else {
            $y = $absX + (607.0 / 128.0) + 0.5;
            $gammaAbs = M_SQRT2PI / $x * pow($y, $absX + 0.5) * exp(-$y) * lanczos($absX);
            
            if ($x > 0.0) {
                $ret = $gammaAbs;
            } else {
                /*
                 * From the reflection formula
                 * Gamma(x) * Gamma(1 - x) * sin(pi * x) = pi,
                 * and the recurrence relation
                 * Gamma(1 - x) = -x * Gamma(-x),
                 * it is found
                 * Gamma(x) = -pi / [x * sin(pi * x) * Gamma(-x)].
                 */
                $ret = -M_PI / ($x * sin(M_PI * $x) * $gammaAbs);
            }
        }
        
        return $ret;
    }
}

if (!function_exists('ierf')) {
    /**
     * ierf
     * 
     * Returns the inverse real error function of a number.
     * More information can be found at
     * http://en.wikipedia.org/wiki/Error_function#Inverse_function
     * 
     * @param float $x Argument to the real error function
     * @return float A value between -1 and 1
     */
    function ierf($x)
    {
        /* Code borrowed from the Apache Project Commons Math
         * see http://commons.apache.org/proper/commons-math/apidocs/org/apache/commons/math3/special/Erf.html
         * and http://svn.apache.org/repos/asf/commons/proper/math/trunk/src/main/java/org/apache/commons/math3/special/Erf.java
         * 
         * The Apache implementation is described in the paper:
         * http://people.maths.ox.ac.uk/gilesm/files/gems_erfinv.pdf (Approximating
         * the erfinv function) by Mike Giles, Oxford-Man Institute of Quantitative Finance,
         * which was published in GPU Computing Gems, volume 2, 2010.
         * The source code is available at http://gpucomputing.net/?q=node/1828.
         *
         * "Translated" to PHP (2013-10-12, fiedsch@ja-eh.at)
         */
        
        // [Apache version comment]
        // beware that the logarithm argument must be
        // commputed as (1.0 - x) * (1.0 + x),
        // it must NOT be simplified as 1.0 - x * x as this
        // would induce rounding errors near the boundaries +/-1

        $w = -log((1.0 - $x) * (1.0 + $x));
      
        if ($w < 6.25) {
            $w = $w - 3.125;
            $p =  -3.6444120640178196996e-21;
            $p =   -1.685059138182016589e-19 + $p * $w;
            $p =   1.2858480715256400167e-18 + $p * $w;
            $p =    1.115787767802518096e-17 + $p * $w;
            $p =   -1.333171662854620906e-16 + $p * $w;
            $p =   2.0972767875968561637e-17 + $p * $w;
            $p =   6.6376381343583238325e-15 + $p * $w;
            $p =  -4.0545662729752068639e-14 + $p * $w;
            $p =  -8.1519341976054721522e-14 + $p * $w;
            $p =   2.6335093153082322977e-12 + $p * $w;
            $p =  -1.2975133253453532498e-11 + $p * $w;
            $p =  -5.4154120542946279317e-11 + $p * $w;
            $p =    1.051212273321532285e-09 + $p * $w;
            $p =  -4.1126339803469836976e-09 + $p * $w;
            $p =  -2.9070369957882005086e-08 + $p * $w;
            $p =   4.2347877827932403518e-07 + $p * $w;
            $p =  -1.3654692000834678645e-06 + $p * $w;
            $p =  -1.3882523362786468719e-05 + $p * $w;
            $p =    0.0001867342080340571352 + $p * $w;
            $p =  -0.00074070253416626697512 + $p * $w;
            $p =   -0.0060336708714301490533 + $p * $w;
            $p =      0.24015818242558961693 + $p * $w;
            $p =       1.6536545626831027356 + $p * $w;
        } elseif ($w < 16.0) {
            $w = sqrt($w) - 3.25;
            $p =   2.2137376921775787049e-09;
            $p =   9.0756561938885390979e-08 + $p * $w;
            $p =  -2.7517406297064545428e-07 + $p * $w;
            $p =   1.8239629214389227755e-08 + $p * $w;
            $p =   1.5027403968909827627e-06 + $p * $w;
            $p =   -4.013867526981545969e-06 + $p * $w;
            $p =   2.9234449089955446044e-06 + $p * $w;
            $p =   1.2475304481671778723e-05 + $p * $w;
            $p =  -4.7318229009055733981e-05 + $p * $w;
            $p =   6.8284851459573175448e-05 + $p * $w;
            $p =   2.4031110387097893999e-05 + $p * $w;
            $p =   -0.0003550375203628474796 + $p * $w;
            $p =   0.00095328937973738049703 + $p * $w;
            $p =   -0.0016882755560235047313 + $p * $w;
            $p =    0.0024914420961078508066 + $p * $w;
            $p =   -0.0037512085075692412107 + $p * $w;
            $p =     0.005370914553590063617 + $p * $w;
            $p =       1.0052589676941592334 + $p * $w;
            $p =       3.0838856104922207635 + $p * $w;
        } elseif (is_infinite($w)) {
            $w = sqrt($w) - 5.0;
            $p =  -2.7109920616438573243e-11;
            $p =  -2.5556418169965252055e-10 + $p * $w;
            $p =   1.5076572693500548083e-09 + $p * $w;
            $p =  -3.7894654401267369937e-09 + $p * $w;
            $p =   7.6157012080783393804e-09 + $p * $w;
            $p =  -1.4960026627149240478e-08 + $p * $w;
            $p =   2.9147953450901080826e-08 + $p * $w;
            $p =  -6.7711997758452339498e-08 + $p * $w;
            $p =   2.2900482228026654717e-07 + $p * $w;
            $p =  -9.9298272942317002539e-07 + $p * $w;
            $p =   4.5260625972231537039e-06 + $p * $w;
            $p =  -1.9681778105531670567e-05 + $p * $w;
            $p =   7.5995277030017761139e-05 + $p * $w;
            $p =  -0.00021503011930044477347 + $p * $w;
            $p =  -0.00013871931833623122026 + $p * $w;
            $p =       1.0103004648645343977 + $p * $w;
            $p =       4.8499064014085844221 + $p * $w;
        } else {
            // [Apache version comment]
            // this branch does not appears in the original code, it
            // was added because the previous branch does not handle
            // x = +/-1 correctly. In this case, w is positive infinity
            // and as the first coefficient (-2.71e-11) is negative.
            // Once the first multiplication is done, p becomes negative
            // infinity and remains so throughout the polynomial evaluation.
            // So the branch above incorrectly returns negative infinity
            // instead of the correct positive infinity.
            // 
            // p = Double.POSITIVE_INFINITY;
            $p = INF; 
        }
      
        return $p * $x;
    }
}