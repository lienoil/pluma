<?php

namespace Role\Models;

use Pluma\Models\Model;
use Role\Support\Relations\BelongsToManyRoles;

class Permission extends Model
{
    use BelongsToManyRoles;

    protected $fillable = [
        'name',
        'code',
        'description',
        'group',
    ];

    protected $searchables = [
        'name',
        'code',
        'description',
        'updated_at',
        'created_at',
    ];
}
