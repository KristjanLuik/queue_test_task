<?php
/**
 * Created by PhpStorm.
 * User: Kristjan
 * Date: 3.10.2015
 * Time: 19:36
 */



require_once __DIR__ . '/vendor/autoload.php';
require_once('Interestcalculator.php');
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class InterestBroadcaster
{


    public static function execute($entry)
    {
        if (!empty($entry)) {
            $connection = new AMQPConnection(
                'impact.ccat.eu',
                5672,
                'myjar',
                'myjar'
            );
            $channel = $connection->channel();

            $msg = new AMQPMessage($entry, array('content_type' => 'application/json'));
            $channel->basic_publish(
                $msg,
                '',
                'solved-interest-queue'
            );

            $channel->close();
            $connection->close();

        }


    }

}