<?php

namespace App\Controllers;

use App\Exception\UnexpectedBehaviorException;
use App\Layout;
use App\Request;

abstract class Controller
{
    protected Request $request;
    protected array $errors;

    public function __construct(
        protected Layout $layout
    )
    {
        $this->request = Request::getInstance();
    }

    protected function handleRequest()
    {
        $this->handleGet();
        if ($this->request->getMethod() === 'get') {
            return $this->layout->render();
        }
        if ($this->request->getMethod() === 'post') {
            $this->handlePost();
            return $this->layout->render();
        }

        throw new UnexpectedBehaviorException();
    }

    protected function handleGet()
    {
        $params = $this->request->getGetParams();
        $this->layout->addParams($params);
    }

    protected function handlePost()
    {
        $params = $this->fillParams();
        $this->layout->addParams($params ?: []);
    }

    abstract protected function fillParams(): array;
}