<?php

namespace Pluma\Providers;

use Illuminate\Support\AggregateServiceProvider;
use Pluma\Providers\QueueServiceProvider;

class ApplicationServiceProvider extends AggregateServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        FormRequestServiceProvider::class,
        // QueueServiceProvider::class,
    ];
}
