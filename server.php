<?php

require './vendor/autoload.php';

$server = new Hoa\Websocket\Server(
    new Hoa\Socket\Server('tcp://0.0.0.0:8080')
);

$server->on(
    'open',
    function(Hoa\Core\Event\Bucket $bucket) {
        echo "New connection.\n";

        $bucket->getSource()->send('Message from server');
    }
);

$server->on(
    'message',
    function(Hoa\Core\Event\Bucket $bucket) {
        $data = $bucket->getData();

        echo 'New message: "', $data['message'], '"' . PHP_EOL;
    }
);

$server->run();