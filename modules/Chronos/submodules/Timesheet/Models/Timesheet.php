<?php

namespace Timesheet\Models;

use Category\Support\Traits\CategoryMutatorTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Timesheet\Support\Traits\HasManyDailies;
use Timesheet\Support\Traits\TimesheetMutator;
use User\Support\Traits\BelongsToUser;

class Timesheet extends Model
{
    use SoftDeletes, BelongsToUser, CategoryMutatorTrait, TimesheetMutator, HasManyDailies;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
