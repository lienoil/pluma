<?php

namespace Page\Models;

use Category\Support\Relations\BelongsToCategory;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Page\Support\Mutators\PageMutator;
use Page\Support\Accessors\PageAccessors;
use Page\Support\Relations\BelongsToPage;
use Page\Support\Relations\PageHasManyPages;
use Page\Support\Traits\PageValidationTrait;
use Pluma\Models\Model;
use Pluma\Support\Database\Scopes\CodeOrFailScope;
use User\Support\Traits\BelongsToUser;

class Page extends Model
{
    use BelongsToCategory,
        BelongsToPage,
        BelongsToUser,
        PageHasManyPages,
        PageMutator,
        PageValidationTrait,
        CodeOrFailScope,
        SoftDeletes;

    protected $fillable = [
        'title',
        'code',
        'body',
        'delta',
    ];

    protected $appends = [
        'created',
        'modified',
        'removed',
    ];

    protected $searchables = [
        'title',
        'code',
        'body',
        'template',
        'created_at',
        'updated_at',
    ];
}
