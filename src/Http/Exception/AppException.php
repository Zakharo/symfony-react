<?php

namespace App\Http\Exception;

class AppException extends \DomainException
{
    public function __construct(string $message = '', int $code = 406)
    {
        parent::__construct($message, $code);
    }
}
