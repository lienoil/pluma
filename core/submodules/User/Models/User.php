<?php

namespace User\Models;

use Pluma\Support\Auth\User as Authenticatable;
use Pluma\Support\Token\Traits\TokenizableTrait;
use Role\Support\Relations\BelongsToManyRoles;
use Role\Support\Relations\HasManyPermissionsThroughRoles;
use Setting\Support\Relations\HasManySettings;
use Setting\Support\Traits\WhereSettingTrait;
use User\Scopes\LoadAvatarPhotosScope;
use User\Support\Relations\HasManyDetails;
use User\Support\Traits\CanResetPasswordTrait;
use User\Support\Traits\WhereDetailTrait;

class User extends Authenticatable
{
    use BelongsToManyRoles,
        CanResetPasswordTrait,
        HasManyDetails,
        HasManyPermissionsThroughRoles,
        HasManySettings,
        LoadAvatarPhotosScope,
        TokenizableTrait,
        WhereDetailTrait,
        WhereSettingTrait;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'username',
        'prefixname',
        'email',
        'password',
    ];

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
        'email' => 'sometimes|required|email|unique:users',
        // 'roles' => 'required',
    ];

    public static $messages = [
        'roles.required' => 'Atleast one role is required.',
    ];
}
