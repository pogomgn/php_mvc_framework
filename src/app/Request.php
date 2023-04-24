<?php

namespace App;

class Request
{
    protected string $path = '';
    protected array $params = [];
    protected string $method = '';

    protected static ?Request $instance = null;

    protected function __construct()
    {
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $uri = $_SERVER['REQUEST_URI'] ?? '/';

        [$path, $params] = explode('?', $uri);

        $this->path = $path;
        $this->params = explode('&', $params ?: '');
    }

    public static function getInstance(): Request
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}