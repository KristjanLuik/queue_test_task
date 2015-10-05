<?php

/**
 * Created by PhpStorm.
 * User: Kristjan
 * Date: 3.10.2015
 * Time: 17:56
 */

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
require_once('InterestBroadcaster.php');


/**
 * Class InterestReceiver
 */
class InterestReceiver
{

    public  function listen()
    {

        $connection = new AMQPConnection(
            'impact.ccat.eu',
            5672,
            'myjar',
            'myjar'
        );
        $channel = $connection->channel();


        $callback = function ($msg) {
            if (!empty($msg->body)) {
                $entry = json_decode($msg->body,true);
                if (!empty($entry)) {
                    $entry = InterestCalculator::calculate(
                        $entry['sum'],
                        $entry['days']
                    );
                    if ($entry) {
                        $entry['token'] = 'Luik';
                        InterestBroadcaster::execute(json_encode($entry));
                    }
                }
            }

        };

        $channel->basic_consume(
            'interest-queue',
            '',
            false,
            true,
            false,
            false,
            $callback
        );

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}