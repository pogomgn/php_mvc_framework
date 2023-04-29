<?php

use App\Application;
use App\Controllers\FeedbackController;
use App\Layout;
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

$router->get('/',  new Layout('main', ['content' => 'home'], ['title' => 'Home title']));
$router->get('/contact',  new Layout('main', ['content' => 'contact'], ['title' => 'Contact title']));
$router->get('/feedback', new Layout('main', ['content' => 'feedback'], ['title' => 'Feedback title']));
$router->post('/feedback', [
    (new FeedbackController(new Layout('main', ['content' => 'feedback'], ['title' => 'Feedback title']))),
    'postFeedback',
]);

$app = new Application($router, Request::getInstance());

$app->run();
