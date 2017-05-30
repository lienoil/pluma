<?php

namespace Pluma\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Pluma\Support\Exceptions\Handler as BaseHandler;

class Handler extends BaseHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
    public function render($request, Exception $exception)
    {
        // if ( $exception instanceof \PDOException || $exception instanceof \Illuminate\Database\QueryException ) {
        //  return redirect()->route('pluma.installation');
        // }

        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response()->view("Pluma::errors.404", [
                'error' => [
                    'code' => 'NOT_FOUND',
                    'message' => $exception->getMessage(),
                    'description' => 'The page you requested was not found.',
                ]
            ], 404);
        }

        if (($exception instanceof \ReflectionException) && (auth()->user() && ! auth()->user()->isRoot())) {
            return response()->view('Pluma::errors.exceptions', [
                'error' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage(),
                    'description' => "An application error occured, log in as /dev/ to view the error.",
                ]
            ]);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->view('Pluma::errors.404', [
                'error' => [
                    'code' => 'NOT_FOUND',
                    'message' => $exception->getMessage(),
                    'description' => 'The page you requested was not found.',
                ]
            ], 404);
        }

        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return response()->view('Pluma::errors.403', [
                'error' => [
                    'code' => 'NOT_AUTHORIZED',
                    'message' => $exception->getMessage(),
                    'description' => 'Unauthorized request.',
                ]
            ], 403);
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
