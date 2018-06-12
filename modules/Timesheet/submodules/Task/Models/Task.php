<?php

namespace Task\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Task\Support\Mutators\TaskMutator;
use Timesheet\Support\Relations\BelongsToManyTimesheets;

class Task extends Model
{
    use BelongsToManyTimesheets,
        SoftDeletes,
        TaskMutator;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
