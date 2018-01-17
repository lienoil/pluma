<?php

namespace Widget\Models;

use Pluma\Models\Model;
use Role\Support\Traits\BelongsToManyRoles;
use Widget\Support\Scopes\WidgetTrait;

class Widget extends Model
{
	use BelongsToManyRoles, WidgetTrait;

    protected $with = [];

    protected $fillable = ['name', 'code', 'description', 'icon'];

    protected $searchables = ['created_at', 'updated_at'];
}
