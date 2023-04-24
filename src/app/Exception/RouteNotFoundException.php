<?php

namespace App\Exception;

class RouteNotFoundException extends \Exception
{
    protected $code = 404;
    protected $message = 'Path not found.';
}