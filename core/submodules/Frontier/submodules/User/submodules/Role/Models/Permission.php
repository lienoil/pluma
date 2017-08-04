<?php

namespace Role\Models;

use Pluma\Models\Model;
use Role\Support\Traits\BelongsToManyGrants;

class Permission extends Model
{
    use BelongsToManyGrants;

    protected $fillable = ['name', 'code', 'description'];
}
