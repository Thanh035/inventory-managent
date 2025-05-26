<?php
namespace App\Exceptions;

use Illuminate\Http\Response;

class ResourceNotFoundException extends AbstractException
{
    public function __construct($message = '', $code = null)
    {
        if (!$message) {
            $message = __('resource not found exception');
        }

        if (!$code) {
            $code = Response::HTTP_NOT_FOUND;
        }
        parent::__construct($message, $code);
    }
}
