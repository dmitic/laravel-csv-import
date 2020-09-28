<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof HttpException) {
            return $this->errorResponse(Response::$statusTexts[$exception->getStatusCode()], $exception->getStatusCode());
        }

        if ($exception instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("Does not exist any instance of {$model} with the given id", Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof ValidationException) {
            return $this->errorResponse($exception->validator->errors()->getMessages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($exception instanceof NoTypeDetectedException) {
            return $this->errorResponse('Wrong file type, it should be CSV file.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if(env('APP_DEBUG', false)){
            return parent::render($request, $exception);
        }

        return $this->errorResponse('Unexpected error. Try later', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
