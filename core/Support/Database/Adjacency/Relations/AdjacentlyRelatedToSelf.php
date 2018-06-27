<?php

namespace Pluma\Support\Database\Adjacency\Relations;

use Illuminate\Database\Eloquent\Builder;

trait AdjacentlyRelatedToSelf
{
    /**
     * Retrieves the lineage of the adjacently listed resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function adjaceables()
    {
        return $this->adjacentlyRelatedTo();
    }

    /**
     * Gets the mutated descendants attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDescendantsAttribute()
    {
        return $this->adjacent->descendants();
    }

    /**
     * Gets the mutated children attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getChildrenAttribute()
    {
        return $this->adjacent->children();
    }

    /**
     * Gets the mutated ancestors attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAncestorsAttribute()
    {
        return $this->adjacent->ancestors();
    }

    /**
     * Gets the mutated parent attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getParentAttribute()
    {
        return $this->adjacent->parent();
    }
}
