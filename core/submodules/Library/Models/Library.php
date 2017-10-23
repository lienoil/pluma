<?php

namespace Library\Models;

use Catalogue\Support\Scopes\OfCatalogue;
use Catalogue\Support\Traits\BelongsToCatalogue;
use Illuminate\Database\Eloquent\SoftDeletes;
use Library\Support\Mutators\LibraryMutator;
use Pluma\Models\Model;

class Library extends Model
{
    use SoftDeletes, LibraryMutator, BelongsToCatalogue, OfCatalogue;

    protected $table = 'library';

    protected $with = [];

    protected $appends = ['filesize', 'icon', 'thumbnail', 'created', 'modified'];

    protected $searchables = ['url', 'name', 'mimetype', 'originalname', 'thumbnail', 'size', 'created_at', 'updated_at'];
}
