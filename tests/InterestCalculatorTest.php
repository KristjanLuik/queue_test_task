<?php

/**
 * Created by PhpStorm.
 * User: Kristjan
 * Date: 5.10.2015
 * Time: 23:41
 */
require_once('InterestBroadcaster.php');
class InterestCalculatorTest extends PHPUnit_Framework_TestCase
{

    /**
     *Test know interest amount.
     */
    function test_Calculator_Interest()
    {
        $calc = new InterestCalculator();
        $valus = $calc->calculate(123,5);
          $this->assertThat(
              18.45,
              $this->equalTo($valus['interest'])

          );
    }

    function  test_Calulator_Total_Sum()
    {
        $calc = new InterestCalculator();
        $valus = $calc->calculate(123,5);
        $this->assertThat(
            141.45,
            $this->equalTo($valus['totalSum'])

        );
    }


}
