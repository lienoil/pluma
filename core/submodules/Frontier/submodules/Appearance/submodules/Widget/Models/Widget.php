<?php

namespace Widget\Models;

use Pluma\Models\Model;

class Widget extends Model
{
    protected $with = [];

    protected $fillable = ['name', 'code', 'description', 'icon'];

    protected $searchables = ['created_at', 'updated_at'];
}
