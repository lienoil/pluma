<?php

namespace Role\Models;

use Pluma\Models\Model;

class Grant extends Model
{
    use BelongsToManyRoles;
}
