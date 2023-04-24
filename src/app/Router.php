<?php

namespace App;

use App\Exception\RouteNotFoundException;

class Router
{
    protected Request $request;

    protected array $routes = [
        'get' => [],
        'post' => [],
    ];


    public function __construct()
    {
        $this->request = Request::getInstance();
    }


    public function get(string $path, callable $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, callable $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if (false === $callback) {
            throw new RouteNotFoundException();
        }

        echo call_user_func($callback);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}