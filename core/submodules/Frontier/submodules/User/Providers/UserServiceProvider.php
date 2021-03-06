<?php

namespace User\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Pluma\Support\Auth\AuthServiceProvider;
use User\Models\User;
use User\Policies\UserPolicy;

class UserServiceProvider extends AuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\User\Models\User::class, '\User\Observers\UserObserver'],
        [\User\Models\Detail::class, '\User\Observers\DetailObserver'],
    ];

    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        PasswordServiceProvider::class,
    ];

    /**
     * Boot the service.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->bootBladeDirectives();
    }

    /**
     * Registers additional Blade Directives in the context of this module.
     *
     * @return void
     */
    public function bootBladeDirectives()
    {
        Blade::directive('user', function ($expression) {
            return "<?php if (user()->id === $expression) : ?>";
        });

        Blade::directive('enduser', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('owned', function ($expression) {
            return "<?php if (user()->id === $expression) : ?>";
        });

        Blade::directive('endowned', function () {
            return "<?php endif; ?>";
        });
    }
}
