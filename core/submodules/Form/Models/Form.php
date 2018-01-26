<?php

namespace Form\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Form\Support\Relations\BelongsToForm;
use Form\Support\Relations\FormHasManyForms;
use Form\Support\Traits\FormMutatorTrait;
use Field\Support\Relations\HasManyFields;
use Pluma\Support\Database\Scopes\SlugOrFail;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Form extends Model
{
    use SoftDeletes, SlugOrFail, BelongsToForm, BelongsToUser, FormHasManyForms, FormMutatorTrait, HasManyFields;

    protected $with = ['fields'];

    protected $fillable = ['id', 'name', 'code', 'action', 'method', 'type', 'attributes', 'body', 'delta', 'success_message', 'error_message'];

    protected $appends = ['author', 'created', 'modified', 'removed'];

    protected $searchables = ['name', 'code', 'body', 'template', 'created_at', 'updated_at'];
}
