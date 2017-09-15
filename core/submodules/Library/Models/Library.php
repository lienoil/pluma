<?php

namespace Library\Models;

use Catalogue\Support\Traits\HasOneCatalogue;
use Illuminate\Database\Eloquent\SoftDeletes;
use Library\Support\Mutators\LibraryMutator;
use Pluma\Models\Model;

class Library extends Model
{
    use SoftDeletes, LibraryMutator, HasOneCatalogue;

    protected $table = 'library';

    protected $with = [];

    protected $appends = ['thumbnail', 'filesize', 'icon'];

    protected $searchables = ['url', 'name', 'created_at', 'updated_at'];
}
