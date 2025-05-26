<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class DuplicateResourceException extends AbstractException
{
    public function __construct($message = '', $code = null)
    {
        if (!$message) {
            $message = __('exception.conflict');
        }

        if (!$code) {
            $code = Response::HTTP_CONFLICT;
        }
        parent::__construct($message, $code);
    }
}
