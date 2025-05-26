<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class UnauthorizedException extends AbstractException
{
    public function __construct($message = '', $code = null)
    {
        if (!$message) {
            $message = __('Unauthorized access');
        }

        if (!$code) {
            $code = Response::HTTP_UNAUTHORIZED;
        }
        parent::__construct($message, $code);
    }
}
