<?php

namespace Timesheet\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Timesheet extends Model
{
    use SoftDeletes, BelongsToUser;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
