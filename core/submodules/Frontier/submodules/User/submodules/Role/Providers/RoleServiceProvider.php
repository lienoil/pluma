<?php

namespace Role\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Role\Models\Grant;
use Role\Observers\GrantObserver;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Role\Models\Grant::class, \Role\Observers\GrantObserver::class],
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootObservables();
    }

    /**
     * Bootstraps the Observables.
     *
     * @return void
     */
    public function bootObservables()
    {
        Grant::observe(GrantObserver::class);
        foreach ($this->observables as $observable) {
            if ( Schema::hasTable(with($this->app->make($observable[0]))->getTable()) ) {
                $this->app->make($observable[0])::observe($observable[1]);
            }
        }
    }
}
