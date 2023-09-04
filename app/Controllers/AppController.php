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

        $user = new User();

//        $user = $user->create([
//            'id' => 10,
//            'name' => 'Sergio Danilo Jr',
//            'email' => 'sergio@email.com',
//            'password' => password_hash('password', PASSWORD_BCRYPT),
//            'created_at'=>date('Y-m-d H:i:s'),
//        ]);

        $user->name = 'Bagual';

        dd($user);

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