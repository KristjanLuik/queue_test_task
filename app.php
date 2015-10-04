<?php
/**
 * Created by PhpStorm.
 * User: Kristjan
 * Date: 3.10.2015
 * Time: 17:43
 */

chdir(dirname(__DIR__));

require_once('vendor/autoload.php');
require_once('InterestReceiver.php');
require_once('Interestcalculator.php');
$reciver = new InterestReceiver();
$reciver->listen();
