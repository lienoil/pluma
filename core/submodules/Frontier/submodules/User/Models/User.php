<?php

namespace User\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Pluma\Models\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes, UserMutator;
    // use HasRole, , UserDetailMutator, DateMutator, SoftDeletes, Notifiable, HasManyTasks;

    // public $with = ['detail'];

    // /**
    //  * Send the password reset notification.
    //  *
    //  * @param  string  $token
    //  * @return void
    //  */
    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new ResetPasswordNotification($token));
    // }
}
