<?php

use App\Application;
use App\Request;
use App\Router;

error_reporting(E_ERROR | E_PARSE);

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router = new Router(Request::getInstance());

$router->get('/', function() {
    return 'Hello!';
});
$router->get('/user', fn() => 'hahaha');

$app = new Application($router, Request::getInstance());

$app->run();
