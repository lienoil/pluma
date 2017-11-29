<?php

namespace Timesheet\Models;

use Category\Support\Traits\BelongsToCategory;
use Category\Support\Traits\CategoryMutators;
use Pluma\Models\Model;
use Timesheet\Support\Traits\BelongsToTimesheet;

class Daily extends Model
{
    use BelongsToTimesheet, BelongsToCategory, CategoryMutators;

    protected $with = [];

    protected $searchables = ['name', 'created_at', 'updated_at'];
}
