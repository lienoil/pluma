<?php

namespace Calendar\Models;

use Calendar\Support\Holidays\Holidays;
use Pluma\Models\Model;

class Calendar extends Model
{
    use Holidays;

    /**
     * Toggle timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
