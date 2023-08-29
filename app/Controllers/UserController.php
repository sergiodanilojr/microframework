<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserController
{
    public function index(ServerRequestInterface $request):ResponseInterface
    {
        $response = new \Laminas\Diactoros\Response;
        $response->getBody()->write("listagem de usuários");
        return $response;
    }
}