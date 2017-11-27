<?php

namespace Menu\Models;

use Menu\Support\Traits\BelongsToMenu;
use Menu\Support\Traits\MenuBuilderTrait;
use Pluma\Models\Model;

class Menu extends Model
{
    use MenuBuilderTrait, BelongsToMenu;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
