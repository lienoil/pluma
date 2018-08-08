<?php

namespace Course\Models;

class Scormvar extends Model
{
    use BelongsToUser;

    protected $table = 'scomvars';

    protected $fillable = ['course_id', 'content_id', 'user_id', 'name', 'val'];

    protected $softDelete = false;
}
