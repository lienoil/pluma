<?php

namespace Setting\Models;

use Pluma\Models\Model;
use Setting\Support\Traits\Keyable;

class Setting extends Model
{
    use Keyable;

    protected $fillable = ['key', 'value'];
}
