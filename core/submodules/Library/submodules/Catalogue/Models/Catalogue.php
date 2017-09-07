<?php

namespace Catalogue\Models;

use Catalogue\Support\Traits\HasManyLibraries;
use Catalogue\Support\Traits\MorphToCatalogable;
use Category\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalogue extends Category
{
    use SoftDeletes, MorphToCatalogable, HasManyLibraries;

    protected $with = ['libraries'];

    protected $searchables = ['name', 'code', 'alias', 'description', 'icon', 'created_at', 'updated_at'];
}
