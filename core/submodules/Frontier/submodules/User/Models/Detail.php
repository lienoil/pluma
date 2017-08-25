<?php

namespace User\Models;

use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Detail extends Model
{
    use BelongsToUser;

    protected $with = [];

    protected $searchables = ['gender', 'sex', 'birthday', 'phone', 'address'];
}
