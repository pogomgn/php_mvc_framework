<?php

namespace App;

use App\Exception\ViewNotFoundException;

class Render
{
    protected function includeView(string $path): string
    {
        $path = APP_DIR . '/Views/' . $path . '.php';
        if (!file_exists($path)) {
            throw new ViewNotFoundException();
        }
        ob_start();
        $this->includePath($path);
        $buffer = ob_get_clean();
        return (string)$buffer;
    }

    public function renderView($view)
    {
        $path = APP_DIR . '/Views/' . $view . '.php';
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