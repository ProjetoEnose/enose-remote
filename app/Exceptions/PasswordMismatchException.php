<?php

namespace App\Exceptions;

use Exception;

class PasswordMismatchException extends Exception
{
    public function __construct($message = "A senha fornecida não corresponde à senha atual.")
    {
        parent::__construct($message);
    }
}
