<?php

namespace App\Controllers;

class FeedbackController extends Controller
{

    private array $params = [];

    public function postFeedback(): string
    {
        $params = $this->request->getPostParams();

        $this->params['save_result'] = 'Save feedback: ' . $params['email'] . ' - ' . $params['feedback'];

        return $this->handleRequest();
    }

    protected function fillParams(): array
    {
        return $this->params;
    }
}