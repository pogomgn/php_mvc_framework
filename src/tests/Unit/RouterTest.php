<?php

namespace Tests\Unit;

use App\Controllers\Foo;
use App\Exception\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
//    public function test_router_get_method_content()
//    {
//        $router = new Router();
//
//        $router->get('/asd', function () {
//            return 'test';
//        });
//
//        $_SERVER['REQUEST_METHOD'] = 'GET';
//        $_SERVER['REQUEST_URI'] = '/asd';
//
//        $this->assertEquals('test', $router->resolve());
//    }

    public function test_not_found_exception()
    {
        $this->expectException(RouteNotFoundException::class);
        $this->expectExceptionCode(404);
        $router = new Router();
        $router->resolve();
    }

    public function test_routes_array()
    {
        $router = new Router();
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
}
