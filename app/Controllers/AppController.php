<?php

namespace App\Controllers;

use App\Models\User;
use Core\Database\Connection;
use Core\Database\QB;
use Core\Database\QueryBuilder;
use Core\Http\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class AppController extends Controller
{
    public function index(ServerRequestInterface $request): ResponseInterface
    {

//        $conn = Connection::instance();
//        $stmt = $conn->prepare("SELECT * FROM `users`");
//        $stmt->execute()
//        $data = $stmt->fetchAll();
//        $qb = QueryBuilder::table('users')->select(['id', 'name']);
//        dd($qb);

        $qb = new QB('users');

        $opa = $qb->create([
            'id' => 3,
            'name' => 'Bagual',
            'email' => 'eu@email.com',
            'password' => "123",
            'created_at'=>(new \DateTime())->format('Y-m-d H:i:s'),
        ]);

        dd($opa, $qb->select('name')->get());

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