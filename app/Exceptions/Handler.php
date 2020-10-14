<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Resources\Json\JsonResource;
use Throwable;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        if($exception instanceof ModelNotFoundException) {

            return $this->NotFoundExceptionMessage($request, $exception);
        } elseif ($exception instanceof AuthenticationException) {
            return $request->wantsJson() 
            ? new JsonResource([
                'data' => 'ابتدا باید وارد حساب کاربری خود شوید',
                'status' => 'error'
            ], 404)
            : parent::render($request, $exception);
        }

        return parent::render($request, $exception);
    }

    public function NotFoundExceptionMessage($request, Exception $exception)
    {
        return $request->wantsJson() 
            ? new JsonResource([
                'data' => 'در خواست شما درست نمی باشد',
                'status' => 'error'
            ], 404)
            : parent::render($request, $exception);
    }
}
