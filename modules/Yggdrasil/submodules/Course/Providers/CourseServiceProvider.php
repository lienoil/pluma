<?php

namespace Course\Providers;

use Pluma\Support\Providers\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Course\Models\Course::class, '\Course\Observers\CourseObserver'],
    ];

    /**
     * Registered middlewares on the
     * Service Providers Level.
     *
     * @var mixed
     */
    protected $middlewares = [
        //
    ];

    /**
     * Array of factories path to register.
     *
     * @var array
     */
    protected $factories = [
        //
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->factories[] = get_module('course').'/database/factories';

        parent::register();
    }
}
