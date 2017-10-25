<?php

namespace Comment\Providers;

use Pluma\Support\Providers\ServiceProvider;
use Schema;
use Comment\Models\Comment;
use Comment\Observers\CommentObserver;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [\Comment\Models\Comment::class, '\Comment\Observers\CommentObserver'],
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
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ( Schema::hasTable('comments') ) {
            Comment::observe( CommentObserver::class );
        }
    }
}
