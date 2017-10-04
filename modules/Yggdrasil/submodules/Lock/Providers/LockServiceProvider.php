<?php

namespace Lock\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Providers\ServiceProvider;

class LockServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        //
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootObservables();

        $this->bootGate();

        $this->bootDirectives();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boots the Blade directives.
     *
     * @return void
     */
    public function bootDirectives()
    {
        Blade::directive('unlocked', function ($resource) {
            return "<?php if (! is_null(($resource)->unlocks()->first())) : ?>";
        });
        Blade::directive('endunlocked', function ($resource) {
            return "<?php endif; ?>";
        });
    }

    /**
     * Registers the Permissions as Gate policies.
     *
     * @return void
     */
    public function bootGate()
    {
        if (Schema::hasTable('unlocks')) {
            foreach (\Lock\Models\Unlock::get() as $unlock) {
                Gate::define("unlocked-{$unlock->unlockable->id}", function ($user) use ($unlock) {
                    return $user->id === $unlock->unlockable->id;
                });
            }
        }
    }
}
