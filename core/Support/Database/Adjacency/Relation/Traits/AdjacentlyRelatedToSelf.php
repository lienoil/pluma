<?php

namespace Pluma\Support\Database\Adjacency\Relation\Traits;

use Illuminate\Database\Eloquent\Builder;

trait AdjacentlyRelatedToSelf
{
    /**
     * Retrieves the lineage of the adjacently listed resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function lineage()
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
        return $this->lineage()->descendants();
    }

    /**
     * Gets the mutated children attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getChildrenAttribute()
    {
        return $this->lineage()->children();
    }

    /**
     * Gets the mutated ancestors attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAncestorsAttribute()
    {
        return $this->lineage()->ancestors();
    }

    /**
     * Gets the mutated parent attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getParentAttribute()
    {
        return $this->lineage()->parent();
    }

    /**
     * Retrieve all root nodes.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function scopeRoot()
    {
        return $this->lineage()->root();
    }
}
