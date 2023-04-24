<?php

namespace App;

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
        $this->router->resolve();
        die;
    }
}