<?php

namespace Page\Support\Traits;

trait PageMutators
{
    public static function menus()
    {
        $pages = Page::select(['title', 'slug', 'code', 'id', 'parent_id'])->get();
        // $pages = Traverser
    }
}
