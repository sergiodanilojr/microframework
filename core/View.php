<?php

namespace Core;

use League\Plates\Engine;

class View
{
    private $engine;
    private string $path;

    public function __construct()
    {
        $this->path = config('app.view_dir');
        $this->engine = new Engine(realpath($this->path));
    }

    public function render(string|array $path, array $data)
    {
        $path = is_array($path) ? implode(DIRECTORY_SEPARATOR, $path) : $path;

        return $this->engine->render($path, $data);
    }
}