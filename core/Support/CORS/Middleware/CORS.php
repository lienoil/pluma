<?php

namespace Pluma\Support\CORS\Middleware;

use Closure;
use Asm89\Stack\CorsService;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Http\Request;
use Illuminate\Http\Response as AppResponse;
use Symfony\Component\HttpFoundation\Response;

class CORS
{
    /**
     * CorsService instance.
     *
     * @var CorsService
     */
    protected $cors;

    /**
     * Dispatcher instance.
     *
     * @var Dispatcher
     */
    protected $events;

    /**
     * Inject the CorsService and Dispatcher on initialization.
     *
     * @param CorsService $cors
     */
    public function __construct(CorsService $cors, Dispatcher $events)
    {
        $this->cors = $cors;
        $this->events = $events;
    }

    /**
     * Handle an incoming request. Based on Asm89\Stack\Cors by asm89
     * @see https://github.com/asm89/stack-cors/blob/master/src/Asm89/Stack/Cors.php
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $this->cors->isCorsRequest($request)) {
            return $next($request);
        }

        if ($this->cors->isPreflightRequest($request)) {
            return $this->cors->handlePreflightRequest($request);
        }

        if (! $this->cors->isActualRequestAllowed($request)) {
            return new AppResponse('Not allowed in CORS policy.', 403);
        }

        // Add the headers on the Request Handled event as fallback in case of exceptions
        if (class_exists(RequestHandled::class)) {
            $this->events->listen(RequestHandled::class, function (RequestHandled $event) {
                $this->addHeaders($event->request, $event->response);
            });
        } else {
            $this->events->listen('kernel.handled', function (Request $request, Response $response) {
                $this->addHeaders($request, $response);
            });
        }

        $response = $next($request);

        return $this->addHeaders($request, $response);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    protected function addHeaders(Request $request, Response $response)
    {
        // Prevent double checking
        if (! $response->headers->has('Access-Control-Allow-Origin')) {
            $response = $this->cors->addActualRequestHeaders($response, $request);
        }

        return $response;
    }
}
