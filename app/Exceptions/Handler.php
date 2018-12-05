<?php

namespace App\Exceptions;

use Exception;
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
     * Tratamento de Erros!
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $error404 = '\Symfony\Component\HttpKernel\Exception\NotFoundHttpException';
        $error405 = '\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException';

        if($exception instanceof $error404)
        {
            if($request->expectsJson())
            {
                return response()->json(['ERROR' => 'Rota Nao Encontrada'], $exception->getStatusCode());
            }
        }

        if($exception instanceof $error405)
        {
            if($request->expectsJson())
            {
                return response()->json(['ERROR' => 'Metodo Nao Permitido'], $exception->getStatusCode());
            }
        }
        return parent::render($request, $exception);
    }
}
