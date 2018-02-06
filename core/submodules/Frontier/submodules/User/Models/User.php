<?php

namespace User\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Note\Support\Relations\HasManyNotes;
use Pluma\Models\User as Authenticatable;
use Role\Support\Traits\BelongsToManyPermissionsThroughRoles;
use Role\Support\Traits\BelongsToManyRoles;
use Setting\Support\Relations\HasManySettings;
use Setting\Support\Traits\SettingTrait;
use User\Scopes\Avatar;
use User\Support\Relations\HasManyDetails;
use User\Support\Traits\CanResetPasswordTrait;
use User\Support\Traits\DetailTrait;
use User\Support\Traits\HasOneActivation;

class User extends Authenticatable
{
    use Avatar,
        BelongsToManyRoles,
        CanResetPasswordTrait,
        HasManyDetails, DetailTrait,
        HasManyNotes,
        HasManySettings, SettingTrait,
        HasOneActivation;

    protected $with = [];

    protected $appends = [
        'handlename',
        'propername',
        'displayname',
        'displayrole',
        'fullname',
        'created',
        'modified',
    ];

    protected $searchables = [
        'firstname',
        'middlename',
        'lastname',
        'username',
        'prefixname',
        'email',
    ];
}
