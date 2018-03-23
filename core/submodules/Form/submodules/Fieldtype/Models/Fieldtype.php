<?php

namespace Fieldtype\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Fieldtype\Support\Relations\HasManyFieldtypes;
use Field\Support\Relations\HasManyFields;
use Pluma\Support\Database\Scopes\SlugOrFail;
use User\Support\Traits\BelongsToUser;
use Form\Support\Relations\BelongsToForm;
use Pluma\Models\Model;

class Fieldtype extends Model
{
    use SoftDeletes, SlugOrFail, BelongsToForm, BelongsToUser, HasManyFieldtypes, HasManyFields;

    protected $fillable = ['id', 'name', 'code'];

    protected $appends = ['created', 'modified', 'removed'];

    protected $searchables = ['name', 'code', 'body', 'template', 'created_at', 'updated_at'];
}
