<?php

namespace Pluma\Support\Database\Adjacency\Relation\Traits;

use Pluma\Support\Database\Adjacency\Relation\AdjacentlyRelatedTo;

trait BaseAdjacencyRelationTrait
{
    /**
     * Retrieve the adjacent relation of the resource.
     * Uses the Closure Table Heirarchy Model.
     *
     * @param string $table
     * @param string $firstKey
     * @param string $secondKey
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function adjacentlyRelatedTo($table = null, $firstKey = null, $secondKey = null)
    {
        $table = $table ?: $this->getAdjacentTable();
        $firstKey = $firstKey ?: $this->getAncestorKey();
        $secondKey = $secondKey ?: $this->getDescendantKey();

        return new AdjacentlyRelatedTo($this->newQuery(), $this, $table, $firstKey, $secondKey);
    }

    /**
     * Get the default ancestor key name for the model.
     *
     * @return string
     */
    public function getAncestorKey()
    {
        return $this->ancestorKey ?? 'ancestor_id';
    }

    /**
     * Get the default descendant key name for the model.
     *
     * @return string
     */
    public function getDescendantKey()
    {
        return $this->descendantKey ?? 'descendant_id';
    }

    /**
     * Get the default descendant key name for the model.
     *
     * @return string
     */
    public function getDepthKey()
    {
        return $this->depthKey ?? 'depth';
    }

    /**
     * Get the default adjacent table name for the model.
     *
     * @return string
     */
    public function getAdjacentTable()
    {
        return $this->adjacentTable ?? $this->getTable().'tree';
    }

}
