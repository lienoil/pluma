<?php

namespace Pluma\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Pluma\Support\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
}
