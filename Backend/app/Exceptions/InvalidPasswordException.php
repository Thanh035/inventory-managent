<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class InvalidPasswordException extends AbstractException
{
    public function __construct($message = '', $code = null)
    {
        if (!$message) {
            $message = __('invalid password');
        }

        if (!$code) {
            $code = Response::HTTP_UNPROCESSABLE_ENTITY;
        }
        parent::__construct($message, $code);
    }
}
