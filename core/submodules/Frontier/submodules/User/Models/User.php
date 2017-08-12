<?php

namespace User\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Pluma\Models\User as Authenticatable;
use User\Support\Traits\HasOneActivation;

class User extends Authenticatable
{
    use HasOneActivation;
}
