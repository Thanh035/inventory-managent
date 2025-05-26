<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractException extends Exception
{
    protected $code;
    protected $message = [];

    public function __construct($message = null, $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        $this->code = $code;
        $this->message = $message ?: 'Server Exception';

        parent::__construct($message, $code);
    }

    public function render(Request $request)
    {
        $json = [
            'path' => $request->path(),
            'statusCode' => $this->code,
            'message' => $this->message,
            'localDateTime' => now()->format('d M Y h:i A')
        ];

        return new JsonResponse($json, $this->code);
    }

    public function report()
    {
        Log::emergency($this->message);
    }
}
