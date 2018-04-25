<?php

namespace User\Models;

use Pluma\Support\Auth\User as Authenticatable;
use Role\Support\Relations\BelongsToManyRoles;
use Role\Support\Relations\HasManyPermissionsThroughRoles;
use Role\Support\Traits\RoleBasedAccessControlTrait;
use Setting\Support\Relations\HasManySettings;
use Setting\Support\Traits\SettingTrait;
use User\Scopes\Avatar;
use User\Support\Relations\HasManyDetails;
use User\Support\Traits\CanResetPasswordTrait;
use User\Support\Traits\WhereDetailTrait;


class User extends Authenticatable
{
    use Avatar,
        BelongsToManyRoles,
        CanResetPasswordTrait,
        HasManyDetails,
        HasManyPermissionsThroughRoles,
        HasManySettings,
        RoleBasedAccessControlTrait,
        SettingTrait,
        WhereDetailTrait;

    protected $with = [];

    protected $appends = [];

    protected $searchables = [
        'firstname',
        'middlename',
        'lastname',
        'username',
        'prefixname',
        'email',
    ];

    public static $rules = [
        'firstname' => 'sometimes|required|max:255',
        'lastname' => 'sometimes|required|max:255',
        'password' => 'sometimes|required|min:6|confirmed',
        'username' => 'sometimes|required|regex:/^[\pL\s\-\.\*\#\(0-9)]+$/u|unique:users',
        'email' => 'required|email|unique:users',
        'roles' => 'required',
    ];
}
