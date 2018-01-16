<?php

namespace Pluma\Support\Auth;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Pluma\Support\Auth\Traits\Authorizable;
use Pluma\Support\Auth\Traits\UserMutator;
use Pluma\Support\Database\Scopes\ExceptableTrait;
use Pluma\Support\Database\Scopes\SearchableTrait;
use Pluma\Support\Mutators\BaseMutator;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable,
        Authorizable,
        CanResetPassword,
        UserMutator,
        BaseMutator,
        Notifiable,
        SearchableTrait,
        ExceptableTrait;

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // For observer events
        User::setEventDispatcher(app('events'));
    }
}
