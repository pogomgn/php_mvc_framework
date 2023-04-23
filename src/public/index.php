<?php

use App\Controllers\Foo;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$foo = new Foo();
echo $foo->bar();
echo '<pre>'; var_export($_ENV); echo '</pre>';

//throw new \Exception('asd');
//phpinfo();
