<?php

namespace User\Models;

use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Detail extends Model
{
    use BelongsToUser;

    protected $fillable = ['user_id', 'key', 'value'];

    protected $searchables = ['value'];
}
