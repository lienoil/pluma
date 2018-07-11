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
     * Retrieve the immediate children of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getChildrenAttribute()
    {
        return $this->adjaceables()->children();
    }

    /**
     * Retrieve the descendants attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDescendantsAttribute()
    {
        return $this->adjaceables()->descendants();
    }

    /**
     * Retrieve the ancestors attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAncestorsAttribute()
    {
        return $this->adjaceables()->ancestors();
    }

    /**
     * Retrieve the parent attribute.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getParentAttribute()
    {
        return $this->adjaceables()->parent();
    }

    /**
     * Retrieve next sibling.
     * E.g.
     * ---------------------
     *    Sibling 1  <-- if this is the current $key value
     *    Sibling 2  <-- then we should receive this
     *    Sibling 3
     *    ...
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeNext()
    {
        $keyName = $this->getKeyName();
        $key = $this->getKey();

        return $this->adjaceables()->siblings()->where($keyName, '>', $key)->first();
    }
}
