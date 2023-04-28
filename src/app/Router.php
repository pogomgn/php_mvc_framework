<?php

namespace App;

use App\Exception\ClassNotFoundException;
use App\Exception\MethodNotFoundException;
use App\Exception\RouteNotFoundException;
use App\Exception\UnexpectedBehaviorException;
use App\Exception\ViewNotFoundException;

class Router
{
    protected array $routes = [
        'get' => [],
        'post' => [],
    ];

    public function __construct(
        protected Request $request,
        protected Render $render
    )
    {
    }

    public function get(string $path, callable|array|string $action)
    {
        $this->routes['get'][$path] = $action;
    }

    public function post(string $path, callable|array $action)
    {
        $this->routes['post'][$path] = $action;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $action = $this->routes[$method][$path] ?? false;

        if (false === $action) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_string($action)) {
            $this->render->renderView($action);
            return;
        }

        if (is_array($action) && $method === 'post') {
            
        }

        if (is_array($action)) {
            [$layout, $includes, $placeholders] = $action;

            return $this->render->renderLayout($layout, $includes ?: [], $placeholders ?: []);

            /**
            if (!class_exists($class)) {
                throw new ClassNotFoundException();
            }
            $class = new $class();
            if (!method_exists($class, $method)) {
                throw new MethodNotFoundException();
            }

            return call_user_func_array([$class, $method], []);
            */
        }

        throw new UnexpectedBehaviorException();
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}