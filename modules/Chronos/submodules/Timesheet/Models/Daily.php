<?php

namespace Timesheet\Models;

use Category\Support\Relations\BelongsToCategory;
use Category\Support\Traits\CategoryMutatorTrait;
use Pluma\Models\Model;
use Timesheet\Support\Traits\BelongsToTimesheet;

class Daily extends Model
{
    use BelongsToTimesheet, BelongsToCategory, CategoryMutatorTrait;

    protected $with = [];

    protected $searchables = ['name', 'created_at', 'updated_at'];
}
