<?php

namespace Pluma\Providers;

use Illuminate\Support\AggregateServiceProvider;

class ApplicationServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        FormRequestServiceProvider::class,
    ];
}
