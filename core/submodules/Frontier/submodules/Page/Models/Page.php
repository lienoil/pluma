<?php

namespace Page\Models;

use Page\Support\Traits\BelongsToPage;
use Page\Support\Traits\PageHasManyPages;
use Page\Support\Traits\PageMutators;
use Pluma\Models\Model;
use Pluma\Support\Database\Scopes\SlugOrFail;
use User\Support\Traits\BelongsToUser;

class Page extends Model
{
    use SlugOrFail, BelongsToPage, PageHasManyPages, BelongsToUser, PageMutators;

    protected $searchables = ['title', 'code', 'created_at', 'updated_at'];
}
