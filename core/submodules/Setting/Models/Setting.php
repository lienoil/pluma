<?php

namespace Setting\Models;

use Pluma\Models\Model;
use Setting\Support\Traits\Keyable;
use Setting\Support\Traits\Themeable;

class Setting extends Model
{
    use Keyable, Themeable;

    protected $fillable = ['key', 'value'];

    protected $primaryKey = 'key';
}
