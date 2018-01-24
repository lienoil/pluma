<?php

namespace Field\Models;

use Fieldtype\Support\Relations\BelongsToFieldtype;
use Pluma\Models\Model;

class Field extends Model
{
    use BelongsToFieldtype;
}
