<?php

namespace Profile\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Setting\Support\Relations\HasManySettings;
use Setting\Support\Traits\SettingTrait;
use User\Models\User as BaseUser;

class User extends BaseUser
{
    use SoftDeletes, HasManySettings, SettingTrait;
}
