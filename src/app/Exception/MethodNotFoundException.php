<?php


namespace App\Exception;


class MethodNotFoundException extends \Exception
{
    protected $code = 500;
    protected $message = 'Method not found.';
}