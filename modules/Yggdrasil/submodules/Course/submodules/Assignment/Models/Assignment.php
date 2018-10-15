<?php

namespace Assignment\Models;

use Course\Support\Relations\BelongsToManyUsers;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Assignment extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'code', 'body', 'delta', 'library_id'];

    protected $with = [];

    protected $searchables = ['title', 'code', 'description', 'created_at', 'updated_at'];

    protected $appends = ['author'];
}
