<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof AuthenticationException) {
            return self::response_error('Unauthenticated', 401);
        } elseif ($e instanceof ModelNotFoundException) {
            return self::response_error('Object Not Found', 404);
        } else {
            return self::response_error($e->getMessage(), 500);
        }
    }

    /* wrapper formatter function for error response */
    static function response_error($message, $code) {
        return response()->json(
            [
                'status' => $code,
                'message' => $message,
                'success' => false,
            ], $code
        );
    }
}
