<?php

use App\Application;
use App\Render;
use App\Request;
use App\Router;

error_reporting(E_ERROR | E_PARSE);

define('ROOT_DIR', dirname(__DIR__));
define('APP_DIR', dirname(__DIR__) . '/app');

require_once ROOT_DIR . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_DIR);
$dotenv->load();

$router = new Router(Request::getInstance(), new Render());

$router->get('/', 'home');
$router->get('/user', fn() => 'hahaha');
$router->get('/contact', 'contact');

$app = new Application($router, Request::getInstance());

$app->run();
