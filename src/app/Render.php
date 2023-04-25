<?php

namespace App;

use App\Exception\ViewNotFoundException;

class Render
{
    public function renderLayout(string $layout, array $params)
    {
        ob_start();
        include_once $layout;
        $content = ob_get_clean();
        
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