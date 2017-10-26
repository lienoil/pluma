<?php

namespace Bookmark\Models;

use Bookmark\Support\Traits\MorphToBookmarkable;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Bookmark extends Model
{
    use MorphToBookmarkable, BelongsToUser;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
