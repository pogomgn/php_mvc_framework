<?php

namespace App\Controllers;

use App\Models\RegisterModel;

class AuthController extends Controller
{

    private array $params = [];

    public function login(): string
    {
        $params = $this->request->getPostParams();

        return $this->handleRequest();
    }

    public function register(): string
    {
        $params = $this->request->getPostParams();
        $registerModel = (new RegisterModel())->load($params);

        if (!$registerModel->validate() || !$registerModel->register()) {
            $this->errors = $registerModel->getErrors();
        }

        return $this->handleRequest();
    }

    protected function fillParams(): array
    {
        return array_merge($this->params ?: [], ['errors' => implode('<br>', $this->errors)]);
    }
}