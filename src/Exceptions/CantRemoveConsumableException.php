<?php

namespace CoffeeMachine\Exceptions;

use Exception;
use Throwable;

class CantRemoveConsumableException extends Exception
{
    public function __construct(string $attribute, int $code = 0, Throwable $previous = null)
    {
        $message = 'You canno\'t remove more ' . $attribute;
        parent::__construct($message, $code, $previous);
    }


}