<?php

namespace Blacksmith\Providers;

use Blacksmith\Providers\ConsoleCommandServiceProvider;
use Illuminate\Database\MigrationServiceProvider;
use Illuminate\Support\AggregateServiceProvider;

class ConsoleSupportServiceProvider extends AggregateServiceProvider
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
        // ArtisanServiceProvider::class,
        // MigrationServiceProvider::class,
        ConsoleCommandServiceProvider::class,
        // ComposerServiceProvider::class,
    ];
}
