<?php

$router->get('/api/users', function (): \Psr\Http\Message\ResponseInterface {
    return response(json_encode(['me' => 'from_api']));
});