<?php

namespace User\Models;

use Activity\Support\Relations\MorphManyActivities;
use Frontier\Support\Breadcrumbs\Accessors\Breadcrumable;
use Frontier\Support\Traits\TypeTrait;
use Pluma\Support\Auth\User as Authenticatable;
use Pluma\Support\Token\Traits\TokenizableTrait;
use Role\Support\Relations\BelongsToManyRoles;
use Role\Support\Relations\HasManyPermissionsThroughRoles;
use Setting\Support\Relations\HasManySettings;
use Setting\Support\Traits\WhereSettingTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;
use User\Support\Accessors\UserAccessor;
use User\Support\Relations\HasManyDetails;
use User\Support\Traits\CanResetPasswordTrait;
use User\Support\Traits\WhereDetailTrait;

class User extends Authenticatable implements JWTSubject
{
    use BelongsToManyRoles,
        Breadcrumable,
        CanResetPasswordTrait,
        HasManyDetails,
        HasManyPermissionsThroughRoles,
        HasManySettings,
        MorphManyActivities,
        TokenizableTrait,
        TypeTrait,
        UserAccessor,
        WhereDetailTrait,
        WhereSettingTrait;

    /**
     * The key to use for the breadcrumb middleware.
     *
     * @var string
     */
    protected $crumb = 'fullname';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'username',
        'prefixname',
        'email',
        'password',
        'type',
    ];

    protected $searchables = [
        'firstname',
        'middlename',
        'lastname',
        'username',
        'prefixname',
        'email',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
