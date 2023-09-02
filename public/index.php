<?php

require __DIR__ . '/../vendor/autoload.php';

ob_start();

$response = require __DIR__ . '/../bootstrap/app.php';

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);

ob_end_flush();