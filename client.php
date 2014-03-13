<?php

require './vendor/autoload.php';

$client = new Hoa\Websocket\Client(
    new Hoa\Socket\Client('tcp://home.mattlab.com:8080')
);

$client->on(
    'open',
    function(Hoa\Core\Event\Bucket $bucket) {
        echo "New connection.\n";

        $bucket->getSource()->send('Message from client');
    }
);

$client->on(
    'message',
    function(Hoa\Core\Event\Bucket $bucket) {
        $data = $bucket->getData();

        echo 'New message: "' . $data['message'] . '"' . PHP_EOL;
    }
);

$client->setHost('client');

$client->run();