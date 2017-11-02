<?php

namespace Course\Models;

use Pluma\Models\Model;

class Scormvar extends Model
{
    protected $table = 'scormvars';

    protected $fillable = ['course_id', 'content_id', 'user_id', 'name', 'val'];

    protected $softDelete = false;
}
