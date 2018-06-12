<?php

namespace Timesheet\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Task\Support\Relations\BelongsToManyTasks;
use Timesheet\Support\Mutators\TimesheetMutator;

class Timesheet extends Model
{
    use SoftDeletes,
        TimesheetMutator,
        BelongsToManyTasks;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
