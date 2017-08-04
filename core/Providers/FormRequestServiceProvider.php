<?php

namespace Pluma\Providers;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Routing\Redirector;
use Illuminate\Support\ServiceProvider;
use Pluma\Support\Request\FormRequest;
use Symfony\Component\HttpFoundation\Request;

class FormRequestServiceProvider extends ServiceProvider
{
    /**
     * Boot the service.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootFormRequest();
    }

    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Configure the form request related services.
     *
     * @return void
     */
    private function bootFormRequest()
    {
        $this->app->afterResolving(function (ValidatesWhenResolved $resolved) {
            $resolved->validate();
        });

        $this->app->resolving(function (FormRequest $request, $app) {
            $this->initializeRequest($request, $app['request']);

            $request->setContainer($app)->setRedirector($app->make(Redirector::class));
        });
    }

    /**
     * Initialize the form request with data from the given request.
     *
     * @param  \Pluma\Support\Request\FormRequest  $form
     * @param  \Symfony\Component\HttpFoundation\Request  $current
     * @return void
     */
    protected function initializeRequest(FormRequest $form, Request $current)
    {
        $files = $current->files->all();

        $files = is_array($files) ? array_filter($files) : $files;

        $form->initialize(
            $current->query->all(), $current->request->all(), $current->attributes->all(),
            $current->cookies->all(), $files, $current->server->all(), $current->getContent()
        );

        if ($session = $current->getSession()) {
            $form->setSession($session);
        }

        $form->setUserResolver($current->getUserResolver());

        $form->setRouteResolver($current->getRouteResolver());
    }
}
