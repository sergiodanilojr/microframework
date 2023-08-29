<?php

require __DIR__ .'/vendor/autoload.php';

use App\Controllers\UserController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;

$router->get('/gustavo', function(ServerRequestInterface $request):ResponseInterface
{
    $response = new Laminas\Diactoros\Response;
    $response->getBody()->write('<h1>Hello, Gustavo!</h1>');
    return $response;
});

$router->get('/blog/{nome}', function(ServerRequestInterface $request, $data):ResponseInterface
{
    $response = new Laminas\Diactoros\Response;
    $response->getBody()->write("O nome do artigo é {$data['nome']}");
    return $response;
});

$router->get('users', 'App\Controllers\UserController::index');


$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);