<?php

namespace App;

use const FILTER_SANITIZE_SPECIAL_CHARS;
use const INPUT_GET;

class Request
{
    protected string $path = '';
    protected array $get = [];
    protected array $post = [];
    protected string $method = '';

    protected static ?Request $instance = null;

    protected function __construct()
    {
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $uri = $_SERVER['REQUEST_URI'] ?? '/';

        [$path, $params] = explode('?', $uri);

        $this->path = $path;

        foreach ($_GET as $key => $value) {
            $this->get[$key] = $value;
//            $this->get[$key] = filter_input(INPUT_GET, $value, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if ($this->method === 'post') {
            foreach ($_POST as $key => $value) {
                $this->post[$key] = $value;
//                $this->post[$key] = filter_input(INPUT_POST, $value, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
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

    public function getPostParams(): array
    {
        return $this->post;
    }

    public function getGetParams(): array
    {
        return $this->get;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}