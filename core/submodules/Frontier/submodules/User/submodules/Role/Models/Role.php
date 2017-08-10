<?php

namespace Role\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Role\Support\Traits\BelongsToManyGrants;
use Role\Support\Traits\BelongsToManyUsers;
use Role\Support\Traits\HasManyPermissionsThroughGrants;

class Role extends Model
{
    use SoftDeletes, BelongsToManyUsers, BelongsToManyGrants, HasManyPermissionsThroughGrants;

    protected $with = ['grants'];

    protected $searchables = ['name', 'code', 'description', 'created_at', 'updated_at'];
}
