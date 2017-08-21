<?php

namespace User\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Pluma\Models\User as Authenticatable;
use Role\Support\Traits\BelongsToManyPermissionsThroughRoles;
use Role\Support\Traits\BelongsToManyRoles;
use User\Support\Traits\HasOneActivation;

class User extends Authenticatable
{
    use HasOneActivation, BelongsToManyRoles;

    protected $with = ['roles'];

    /**
     * Appends to both the model's
     * array and JSON forms.
     *
     * @var array
     */
    protected $appends = ['handlename', 'propername', 'displayrole', 'fullname', 'avatar', 'created', 'modified'];
}
