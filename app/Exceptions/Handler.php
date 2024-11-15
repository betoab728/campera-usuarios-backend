<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Response;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        // Aquí puedes agregar excepciones que no quieres reportar en los logs
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
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
     * @return \Illuminate\Http\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Respuesta personalizada para excepciones de Throttle (demasiados intentos)
        if ($exception instanceof ThrottleRequestsException) {
            return response()->json([
                'message' => 'Demasiados intentos. Por favor, intenta de nuevo en unos minutos.',
                'retry_after' => $exception->getHeaders()['Retry-After'] ?? 60 // En segundos
            ], 429);
        }
    
        // Verificar si la solicitud espera JSON para otras excepciones
          // Verificar si la solicitud espera JSON para otras excepciones
    if ($request->expectsJson()) {
        // Determinar el código de estado: si es una excepción HTTP, usa su código de estado; si no, usa 500
        $status = $exception instanceof HttpExceptionInterface
            ? $exception->getStatusCode()
            : Response::HTTP_INTERNAL_SERVER_ERROR;
        
        $error = $exception->getMessage() ?: 'Error en el servidor';

        return response()->json([
            'message' => $error,
            'status' => $status
        ], $status);
    }
    
        // Para otras solicitudes no JSON, usar la respuesta HTML predeterminada
        return parent::render($request, $exception);
    }
    
}
