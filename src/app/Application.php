<?php

namespace App;

use App\Exception\RouteNotFoundException;

class Application
{
    public function __construct(
        public Router $router,
        protected Request $request
    )
    {
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (RouteNotFoundException $e) {
            http_response_code($e->getCode());
            echo $e->getMessage();
            /** TODO: 404.php? */
        }
        die;
    }
}