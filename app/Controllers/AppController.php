<?php

namespace App\Controllers;

use Core\Database\Connection;
use Core\Database\QueryBuilder;
use Core\Http\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AppController extends Controller
{
    public function index(ServerRequestInterface $request): ResponseInterface
    {

//        $conn = Connection::instance();
//
//        $stmt = $conn->prepare("SELECT * FROM `users`");
//
//        $stmt->execute();
//
//        $data = $stmt->fetchAll();

        $qb = QueryBuilder::table('users')->select(['id', 'name']);

        dd($qb);

        return $this->render('app');
    }

    public function opa(ServerRequestInterface $request): ResponseInterface
    {
        return $this->json([
            'data' => [
                'me' => 'bagual',
            ]
        ]);
    }
}