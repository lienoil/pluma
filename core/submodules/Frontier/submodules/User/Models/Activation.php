<?php

namespace User\Models;

use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Activation extends Model
{
    use BelongsToUser;
}
