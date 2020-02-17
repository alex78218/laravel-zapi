<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{

    public function __construct($error)
    {
        parent::__construct($error);
    }
}
