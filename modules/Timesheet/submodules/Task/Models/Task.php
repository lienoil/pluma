<?php

namespace Task\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Task\Support\Mutators\TaskMutator;

class Task extends Model
{
    use SoftDeletes,
        TaskMutator;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
