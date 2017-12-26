<?php

namespace Page\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Page\Support\Relations\BelongsToPage;
use Page\Support\Relations\PageHasManyPages;
use Page\Support\Traits\PageMutatorTrait;
use Pluma\Models\Model;
use Pluma\Support\Database\Scopes\SlugOrFail;
use User\Support\Traits\BelongsToUser;

class Page extends Model
{
    use SoftDeletes, SlugOrFail, BelongsToPage, PageHasManyPages, BelongsToUser, PageMutatorTrait;

    protected $fillable = ['id', 'title', 'code', 'body', 'delta'];

    protected $appends = ['author', 'created', 'modified', 'removed'];

    protected $searchables = ['title', 'code', 'body', 'template', 'created_at', 'updated_at'];
}
