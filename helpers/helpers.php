<?php

if (!function_exists('config')) {
    function config(string $path, string $separator = '.'): mixed
    {
        $pathArr = explode($separator, $path);
        $nameOfFile = $pathArr[0];

        if (!file_exists($config = __DIR__ . '/../config/' . $nameOfFile . ".php")) {
            return null;
        }

        array_shift($pathArr);

        $file = dot(require $config);

        if (empty($pathArr)) {
            return $file->all();
        }

        return dot(require $config)->get(implode($separator, $pathArr));
    }
}

if (!function_exists('view')) {
    function view(string $path, array $data = [], ?string $basePath = null): string
    {
        $view = $basePath ? (new \Core\View($basePath)) : (new \Core\View());

        return $view->render(path_dot_notation($path), $data);
    }
}

if (!function_exists('path_dot_notation')) {
    function path_dot_notation(string $path)
    {
        $path = str_replace(".php", "", $path);

        if (str_contains($path, '.')) {
            $path = implode(DIRECTORY_SEPARATOR, explode('.', $path));
        }

        return $path;
    }
}

if (!function_exists('response')) {
    function response(string $content, int $status = 200): \Psr\Http\Message\ResponseInterface
    {
        $response = (new \Laminas\Diactoros\Response());
        $response->withStatus($status);
        $response->getBody()->write($content);
        return $response;
    }
}

if (!function_exists('env')) {
    function env(string $key, $default = null)
    {
        return $_ENV[$key] ?? ($default ?? null);
    }
}