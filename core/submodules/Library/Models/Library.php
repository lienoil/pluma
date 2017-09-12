<?php

namespace Library\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Library\Support\Mutators\LibraryMutator;
use Pluma\Models\Model;

class Library extends Model
{
    use SoftDeletes, LibraryMutator;

    protected $table = 'library';

    protected $with = [];

    protected $appends = ['thumbnail', 'filesize'];

    protected $searchables = ['url', 'name', 'created_at', 'updated_at'];
}
