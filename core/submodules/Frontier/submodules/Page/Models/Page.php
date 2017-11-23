<?php

namespace Page\Models;

use Frontier\Models\Page as Model;
use Page\Support\Traits\PageHasManyPages;

class Page extends Model
{
    use PageHasManyPages;
}
