<?php

namespace App;

use App\Exception\ViewNotFoundException;

class Render
{
    public function renderLayout(string $layout, array $includes = [], array $placeholders = []): string
    {
        $layout = APP_DIR . '/Views/Layouts/' . $layout . '.php';
        ob_start();
        include_once $layout;
        $buffer = ob_get_clean();

        $what = [];
        $to = [];
        foreach ($placeholders as $ph => $value) {
            $what[] = '{{' . $ph . '}}';
            $to[] = $value;
        }
        foreach ($includes as $ph => $view) {
            $what[] = '{{' . $ph . '}}';
            $to[] = $this->includeView($view);
        }

        $buffer = (string)str_replace($what, $to, $buffer);

        return $buffer;
    }

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