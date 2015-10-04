<?php
/**
 * Created by PhpStorm.
 * User: Kristjan
 * Date: 3.10.2015
 * Time: 19:54
 */



class InterestCalculator
{

    /**
     * @param $sum
     * @param $days
     * @return array|bool
     */
    public static function  calculate($sum, $days)
    {


        if (is_numeric($sum) && is_numeric($days) && $days >0 && sum >0) {
            $totalintrest = 0;
            for ($i=1; $i <= $days; $i++) {
                if (bcmod($i, 3) == 0 && bcmod($i, 5) == 0) {
                    $totalintrest += round((0.03 *$sum), 2);
                } elseif (bcmod($i, 3) == 0) {
                    $totalintrest += round((0.01 *$sum), 2);
                } elseif (bcmod($i, 5) == 0) {
                    $totalintrest += round((0.02 *$sum), 2);
                } else {
                    $totalintrest += round((0.04 *$sum), 2);
                }
            }
            return array(
                'sum' => $sum,
                'days' => $days,
                'interest' => $totalintrest,
                'totalSum' => $sum + $totalintrest,
            );
        }
        return false;
    }
}