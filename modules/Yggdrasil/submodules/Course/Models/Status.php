<?php

namespace Course\Models;

use Pluma\Models\Model;

class Status extends Model
{
    use BelongsToUser;

    protected $table = 'scomvar_statuses';

    protected $fillable = ['course_id', 'content_id', 'user_id', 'name', 'status'];

    protected $softDelete = false;
}
