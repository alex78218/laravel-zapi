<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ApiException extends Exception
{

    public function __construct(array $codeEnum,Throwable $previous = null)
    {
        parent::__construct($codeEnum[1],$codeEnum[0],$previous);
    }
}
