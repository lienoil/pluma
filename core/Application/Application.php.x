<?php

namespace Pluma\Application;

use Illuminate\Container\Container;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Facade;
use Pluma\Providers\PlumaServiceProvider;
use Pluma\Providers\ViewServiceProvider;
use Pluma\Support\Database\Traits\Database;
use Pluma\Support\Env\Traits\Env;
use Pluma\Support\Facades\AliasLoader;
use Pluma\Support\Routes\Traits\Routing;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Application extends Container implements ApplicationContract, HttpKernelInterface
{
    use Env, Routing, Database;

    /**
     * Indicates if the application has "booted".
     *
     * @var bool
     */
    protected $realPath;
    protected $basePath;
    protected $corePath;

    public function __construct($realPath = __DIR__)
    {
        $this->includeHelperFunctions();

        $this->registerClassAliases();

        $this->registerBaseBindings();

        $this->setRealPath($realPath);
        $this->setCorePath("$realPath/core");
    }

    public function start()
    {
        $this->services();
    }

    /**
     * Register a service provider with the application.
     *
     * @param  \Illuminate\Support\ServiceProvider|string  $provider
     * @param  array  $options
     * @param  bool   $force
     * @return \Illuminate\Support\ServiceProvider
     */
    public function register($provider, $options = [], $force = false)
    {
        if (($registered = $this->getProvider($provider)) && ! $force) {
            return $registered;
        }

        // If the given "provider" is a string, we will resolve it, passing in the
        // application instance automatically for the developer. This is simply
        // a more convenient way of specifying your service provider classes.
        if (is_string($provider)) {
            $provider = $this->resolveProviderClass($provider);
        }

        if (method_exists($provider, 'register')) {
            $provider->register();
        }

        // Once we have registered the service we will iterate through the options
        // and set each of them on the application so they will be available on
        // the actual loading of the service objects and for developer usage.
        foreach ($options as $key => $value) {
            $this[$key] = $value;
        }

        $this->markAsRegistered($provider);

        // If the application has already booted, we will call this boot method on
        // the provider class so it has an opportunity to do its boot logic and
        // will be ready for any usage by this developer's application logic.
        if ($this->booted) {
            $this->bootProvider($provider);
        }

        return $provider;
    }

    /**
     * Get the registered service provider instance if it exists.
     *
     * @param  \Illuminate\Support\ServiceProvider|string  $provider
     * @return \Illuminate\Support\ServiceProvider|null
     */
    public function getProvider($provider)
    {
        $name = is_string($provider) ? $provider : get_class($provider);

        return Arr::first($this->serviceProviders, function ($value) use ($name) {
            return $value instanceof $name;
        });
    }

    /**
     * Mark the given provider as registered.
     *
     * @param  \Illuminate\Support\ServiceProvider  $provider
     * @return void
     */
    protected function markAsRegistered($provider)
    {
        $this['events']->fire($class = get_class($provider), [$provider]);

        $this->serviceProviders[] = $provider;

        $this->loadedProviders[$class] = true;
    }

    /**
     * Register the basic bindings into the container.
     *
     * @return void
     */
    protected function registerBaseBindings()
    {
        static::setInstance($this);

        // Tell facade about the application instance
        Facade::setFacadeApplication($this);

        $this->instance('app', $this);

        $this->instance(Illuminate\Container\Container::class, $this);

        $provider = new ViewServiceProvider($this);
        $provider->register();
        $provider->boot();

        $provider = new PlumaServiceProvider($this);
        $provider->boot();
        $provider->register();
    }

    /**
     * Register class Aliases
     *
     * @return void
     */
    public function registerClassAliases()
    {
        $aliases = require __DIR__.'/../../config/aliases.php';
        AliasLoader::getInstance($aliases)->register();
    }

    public function setRealPath($realPath = null)
    {
        $this->realPath = str_finish($realPath, '/');
    }

    public function getRealPath()
    {
        return $this->realPath;
    }

    public function setCorePath($corePath = null)
    {
        $this->corePath = str_finish($corePath, '/');
    }

    public function getCorePath()
    {
        return $this->corePath;
    }

    /**
     * Get the base path of the Laravel installation.
     *
     * @return string
     */
    public function basePath()
    {
        return $this->getRealPath();
    }

    public function corePath()
    {
        return $this->getCorePath();
    }

    private function services()
    {
        $this->booted = true;
    }

    private function includeHelperFunctions()
    {
        include_once __DIR__.'/../helpers/helpers.php';
        include_once __DIR__.'/../helpers/functions.php';
    }

    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function version()
    {
        //
    }

    /**
     * Get or check the current application environment.
     *
     * @return string
     */
    public function environment()
    {
        //
    }

    /**
     * Determine if we are running in the console.
     *
     * @return bool
     */
    public function runningInConsole()
    {
        //
    }

    /**
     * Determine if the application is currently down for maintenance.
     *
     * @return bool
     */
    public function isDownForMaintenance()
    {
        //
    }

    /**
     * Register all of the configured providers.
     *
     * @return void
     */
    public function registerConfiguredProviders()
    {
        //
    }

    /**
     * Register a deferred provider and service.
     *
     * @param  string  $provider
     * @param  string  $service
     * @return void
     */
    public function registerDeferredProvider($provider, $service = null)
    {
        //
    }

    /**
     * Boot the application's service providers.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register a new boot listener.
     *
     * @param  mixed  $callback
     * @return void
     */
    public function booting($callback)
    {
        //
    }

    /**
     * Register a new "booted" listener.
     *
     * @param  mixed  $callback
     * @return void
     */
    public function booted($callback)
    {
        //
    }

    /**
     * Get the path to the cached services.php file.
     *
     * @return string
     */
    public function getCachedServicesPath()
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function handle(SymfonyRequest $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        return $this['Illuminate\Contracts\Http\Kernel']->handle(Request::createFromBase($request));
    }

    public function resourcePath()
    {
        return core_path("resources");
    }
}
