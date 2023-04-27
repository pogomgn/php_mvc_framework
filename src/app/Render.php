<?php

namespace App;

use App\Exception\ViewNotFoundException;

class Render
{
    public function renderLayout(string $layout, string $content = '', array $placeholders = [])
    {
        ob_start();
        include_once $layout;
        $buffer = ob_get_clean();
        $buffer = str_replace('{{content}}', $content, $buffer);

        $what = [];
        $to = [];
        foreach ($placeholders as $ph => $value) {
            $what[] = $ph;
            $to[] = $value;
        }

        $buffer = str_replace($what, $to, $buffer);

        return $buffer;
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