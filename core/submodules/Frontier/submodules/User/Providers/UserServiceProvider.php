<?php

namespace User\Providers;

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
        $this->registerPolicies();

        $this->bootObservables();

        $this->registerProviders();
    }
}
