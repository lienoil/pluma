<?php

namespace Lock\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Lock\Support\Traits\MorphToUnlock;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Unlock extends Model
{
    use MorphToUnlock, BelongsToUser;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
