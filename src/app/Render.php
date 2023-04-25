<?php

namespace App;

use App\Exception\ViewNotFoundException;

class Render
{
    public function renderView($view)
    {
        $path = __DIR__ . '/Views/' . $view . '.php';
        if (!file_exists($path)) {
            throw new ViewNotFoundException();
        }
        $this->includePath($path);
    }

    protected function includePath($path)
    {
        include_once $path;
    }
}