<?php

namespace Page\Support\Traits;

use Crowfeather\Traverser\Traverser;

trait PageMutators
{
    /**
     * Gets the menus from database.
     *
     * @return array
     */
    public static function menus()
    {
        $instance = new static;

        $pages = $instance->select(['title', 'slug', 'code', 'id', 'parent_id'])->get();
        $traverser = new Traverser($pages->toArray(), ['root' => ['id' => 'root']], ['name' => 'id', 'parent' => 'parent_id']);
        $menus = Traverser::recursiveArrayValues($traverser->reorderViaChildKnowsParent(), 'children');

        return json_decode(json_encode($menus));
    }
}
