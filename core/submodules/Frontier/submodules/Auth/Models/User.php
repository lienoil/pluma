<?php

namespace Auth\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Pluma\Support\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    // use HasRole, UserMutator, UserDetailMutator, DateMutator, SoftDeletes, Notifiable, HasManyTasks;

    // public $with = ['detail'];

    // protected $perPage = 10;

    // public function __construct()
    // {
    //     parent::__construct();

    //     $this->perPage = config("settings.pagination_count", 10);
    // }

    // public function ownerships()
    // {
    //     return $this->belongsToMany('\Pluma\Models\Ownership');
    // }

    // public function contents()
    // {
    //     return $this->belongsTo(\Yggdrasil\Models\Content::class);
    // }

    // public function detail()
    // {
    //     return $this->hasOne(Detail::class, 'user_id')->select('*');
    // }

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