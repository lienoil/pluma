<?php

namespace Note\Models;

use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Note extends Model
{
    use BelongsToUser;

    protected $searchables = ['text', 'reminded_at', 'created_at', 'updated_at'];
}
