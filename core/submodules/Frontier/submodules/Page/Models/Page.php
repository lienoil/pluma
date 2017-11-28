<?php

namespace Page\Models;

use Frontier\Models\Page as Model;
use Page\Support\Traits\BelongsToPage;
use Page\Support\Traits\PageHasManyPages;
use Page\Support\Traits\PageMutators;
use User\Support\Traits\BelongsToUser;

class Page extends Model
{
    use BelongsToPage, PageHasManyPages, BelongsToUser, PageMutators;

    protected $searchables = ['title', 'code', 'created_at', 'updated_at'];
}
