<?php

namespace CoffeeMachine\Exceptions;

use Exception;
use Throwable;

class CantAddConsumableException extends Exception
{
    public function __construct(string $attribute, int $code = 0, Throwable $previous = null)
    {
        $message = 'You canno\'t add more ' . $attribute;
        parent::__construct($message, $code, $previous);
    }
}