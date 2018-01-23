<?php

namespace Role\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Role\Support\Traits\BelongsToManyGrants;
use Role\Support\Traits\BelongsToManyPermissionsThroughGrants;
use User\Support\Traits\BelongsToManyUsers;

class Role extends Model
{
    use SoftDeletes,
        BelongsToManyUsers,
        BelongsToManyGrants,
        BelongsToManyPermissionsThroughGrants;

    protected $with = ['grants'];

    protected $fillable = ['name', 'code', 'alias', 'description'];

    protected $searchables = ['name', 'code', 'description', 'created_at', 'updated_at'];
}
