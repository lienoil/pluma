<?php

namespace Category\Models;

use Category\Support\Traits\CategoryMutators;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;

class Category extends Model
{
    use SoftDeletes, CategoryMutators;

    protected $with = [];

    protected $fillable = ['name', 'alias', 'code', 'description', 'icon', 'categorable_type'];

    protected $searchables = ['name', 'alias', 'type', 'code', 'description', 'icon', 'created_at', 'updated_at'];
}
