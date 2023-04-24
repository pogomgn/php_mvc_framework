<?php


namespace App\Exception;


class ClassNotFoundException extends \Exception
{
    protected $code = 500;
    protected $message = 'Class not found.';
}