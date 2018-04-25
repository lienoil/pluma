<?php

namespace Menu\Models;

use Menu\Support\Traits\BelongsToMenu;
use Menu\Support\Traits\MenuBuilderTrait;
use Pluma\Models\Model;
use Pluma\Support\Database\Scopes\SlugOrFailScope;

class Menu extends Model
{
    use SlugOrFailScope, MenuBuilderTrait, BelongsToMenu;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
