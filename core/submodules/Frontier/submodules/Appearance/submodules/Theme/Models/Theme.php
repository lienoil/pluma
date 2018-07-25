<?php

namespace Theme\Models;

use Setting\Models\Setting;
use Setting\Support\Traits\Themeable;

class Theme extends Setting
{
    use Themeable;

    protected $table = 'settings';

    protected $fillable = ['key', 'value'];

    protected $primaryKey = 'key';
}
