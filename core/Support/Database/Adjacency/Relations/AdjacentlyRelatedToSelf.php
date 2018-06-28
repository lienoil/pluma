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
     * Gets the immediate children of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getChildrenAttribute()
    {
        dd($this->adjaceables()->children());
        return $this->adjaceables()->children();
    }

    /**
     * Gets the mutated descendants attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDescendantsAttribute()
    {
        return $this->adjaceables()->descendants();
    }

    /**
     * Gets the mutated ancestors attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAncestorsAttribute()
    {
        return $this->adjaceables()->ancestors();
    }

    /**
     * Gets the mutated parent attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getParentAttribute()
    {
        return $this->adjaceables()->parent();
    }
}
