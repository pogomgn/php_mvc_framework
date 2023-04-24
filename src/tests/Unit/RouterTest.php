<?php

namespace Tests\Unit;

use App\Exception\ClassNotFoundException;
use App\Exception\RouteNotFoundException;
use App\Request;
use App\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    public function test_not_found_exception()
    {
        $this->expectException(RouteNotFoundException::class);
        $this->expectExceptionCode(404);
        $router = new Router(Request::getInstance());
        $router->resolve();
    }

    public function test_routes_array()
    {
        $router = new Router(Request::getInstance());
        $router->get('/getpath', function () {
            return 'test';
        });
        $router->post('/postpath', function () {
            return 'test';
        });
        $paths = $router->getRoutes();

        $this->assertArrayHasKey('/getpath', $paths['get']);
        $this->assertArrayHasKey('/postpath', $paths['post']);
    }

    public function test_class_found_exception()
    {
        $requestMock = $this->createMock(Request::class);
        $requestMock->method('getPath')->willReturn('/');
        $requestMock->method('getMethod')->willReturn('get');

        $this->expectException(ClassNotFoundException::class);
        $this->expectExceptionCode(500);
        $router = new Router($requestMock);

        $router->get('/', ['\App\Controllers\Foo', 'render']);
        $router->resolve();
    }
}
