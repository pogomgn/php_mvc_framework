<?php


namespace App\Exception;


class UnexpectedBehaviorException extends \Exception
{
    protected $code = 500;
    protected $message = 'Unexpected behavior.';
}