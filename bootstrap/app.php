<?php

setlocale(
    LC_ALL,
    config('app.locale'),
    config('app.locale') . '.utf-8',
    config('app.locale'). '.utf-8',
    config('app.language')
);

setlocale(LC_TIME, config('app.language'));

date_default_timezone_set(config('app.timezone'));

Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;

$router->group('', function (\League\Route\RouteGroup $router) {
    $routeFiles = array_filter(array_map(function ($item) {

        $fullPath = realpath(config('app.routes')) . DIRECTORY_SEPARATOR . $item;

        if (is_file($fullPath) && !is_dir($fullPath)) {
            return $fullPath;
        }

    }, scandir(config('app.routes'))));

    array_walk($routeFiles, function ($fileToInclude) use ($router) {
        include $fileToInclude;
    });
});

return $router->dispatch($request);
