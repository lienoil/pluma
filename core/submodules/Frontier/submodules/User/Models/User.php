<?php

namespace User\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Pluma\Models\User as Authenticatable;
use Role\Support\Traits\BelongsToManyPermissionsThroughRoles;
use Role\Support\Traits\BelongsToManyRoles;
use User\Scopes\Avatar;
use User\Support\Traits\HasOneActivation;
use User\Support\Traits\HasOneDetail;

class User extends Authenticatable
{
    use HasOneActivation, BelongsToManyRoles, HasOneDetail, Avatar;

    protected $with = ['roles'];

    protected $appends = ['handlename', 'propername', 'displayname', 'displayrole', 'fullname', 'created', 'modified'];

    protected $searchables = ['firstname', 'middlename', 'lastname', 'username', 'prefixname', 'email'];
}
