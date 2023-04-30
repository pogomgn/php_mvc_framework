<?php

namespace App;

use App\Exception\ClassNotFoundException;
use App\Exception\MethodNotFoundException;
use App\Exception\RouteNotFoundException;
use App\Exception\UnexpectedBehaviorException;
use App\Exception\ViewNotFoundException;
use App\Interface\Renderable;

class Layout extends Render implements Renderable
{

    public function __construct(
        protected string $layoutPath,
        protected array $includes,
        protected array $placeholders,
        protected array $css = [],
        protected array $js = [],
    )
    {
    }

    public function addParams(array $params = [])
    {
        $this->placeholders = array_merge($this->placeholders ?: [], $params);
    }

    public function render(): string
    {
        $layout = APP_DIR . '/Views/Layouts/' . $this->layoutPath . '.php';
        ob_start();
        include_once $layout;
        $buffer = ob_get_clean();

        $what = [];
        $to = [];
        foreach ($this->includes as $ph => $view) {
            $what[] = '{{' . $ph . '}}';
            $to[] = $this->includeView($view);
        }
        $buffer = (string)str_replace($what, $to, $buffer);

        $what = [];
        $to = [];
        foreach ($this->placeholders as $ph => $value) {
            $what[] = '{{' . $ph . '}}';
            $to[] = $value;
        }
        $buffer = (string)str_replace($what, $to, $buffer);

        $fileIncludes = '';
        foreach ($this->css as $ph => $value) {
            $fileIncludes .= "<link href=\"/assets/css/$value\" rel=\"stylesheet\">\r\n";
        }
        foreach ($this->js as $ph => $value) {
            $fileIncludes .= $value . "\r\n";
        }
        $buffer = (string)str_replace('{{head_files}}', $fileIncludes, $buffer);

        $buffer = $this->clearPlaceholders($buffer);

        return $buffer;
    }

    protected function clearPlaceholders(string $buffer)
    {
        $buffer = preg_replace('/{{\w+}}/', '', $buffer);

        return $buffer;
    }
}