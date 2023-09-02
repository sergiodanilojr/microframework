<?php

namespace Core\Http;

use Core\View;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;

abstract class Controller
{
    protected $response;
    protected $view;

    public function __construct()
    {
        $this->response = new \Laminas\Diactoros\Response;
        $this->view = new View();
    }

    protected function json(array $content = [], int $status = 200, array $headers = []): ResponseInterface
    {
        return new JsonResponse($content, $status, $headers);
    }

    protected function render(string|array $path, array $data = [], int $status = 200)
    {
        $content = $this->view->render(path_dot_notation($path), $data);
        $this->write($content, $status);

        return $this->response;
    }

    protected function write(string $content, int $status = 200): ResponseInterface
    {
        $this->response
            ->withStatus($status)
            ->getBody()
            ->write($content);

        return $this->response;
    }
}