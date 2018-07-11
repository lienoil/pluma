<?php

namespace Pluma\Support\Database\Adjacency;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Pluma\Models\Model as BaseModel;
use Pluma\Support\Database\Adjacency\Contracts\AdjacencyRelationModelInterface;
use Pluma\Support\Database\Adjacency\Relation\Scopes\GroupByRootScope;
use Pluma\Support\Database\Adjacency\Relation\Traits\AdjacentlyRelatedToSelf;

class Model extends BaseModel implements AdjacencyRelationModelInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The table adjacently associated with the model.
     *
     * @var string
     */
    protected $adjacentTable;

    /**
     * Qualify model from parameters
     *
     * @param $parameters
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected function qualifyModel($parameters)
    {
        $model = null;

        if ($parameters instanceof Eloquent) {
            $model = $parameters;
        } elseif (is_numeric($parameters)) {
            $model = $this->findOrFail($parameters);
        } else {
            throw (new ModelNotFoundException)->setModel(
                get_class($this->model), $parameters
            );
        }

        return $model;
    }

    /**
     * Inserts new node into closure table.
     *
     * @param int $ancestorId
     * @return mixed
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function insertNodeAsChildOf($ancestorId)
    {
        if (! $this->exists) {
            throw new ModelNotFoundException();
        }

        $query = $this->newModelQuery();
        $table = $this->getAdjacentTable();
        $ancestorKey = $this->getAncestorKey();
        $descendantKey = $this->getDescendantKey();
        $descendantId = $this->getKey();
        $depthKey = $this->getDepthKey();

        $query = "
            INSERT INTO {$table} ({$ancestorKey}, {$descendantKey}, {$depthKey})
            SELECT tbl.{$ancestorKey}, {$descendantId}, tbl.{$depthKey}+1
            FROM {$table} AS tbl
            WHERE tbl.{$descendantKey} = {$ancestorId}
            UNION ALL
            SELECT {$descendantId}, {$descendantId}, 0
            -- ON DUPLICATE KEY UPDATE {$depthKey} = VALUES ({$depthKey})
        ";

        return DB::insert($query);
    }

    /**
     * Inserts self relation to closure table.
     *
     * @return bool
     */
    public function insertSelfToNode()
    {
        if (! $this->exists) {
            throw new ModelNotFoundException();
        }

        $key = $this->getKey();
        $table = $this->getAdjacentTable();
        $ancestorKey = $this->getAncestorKey();
        $descendantKey = $this->getDescendantKey();
        $depthKey = $this->getDepthKey();

        $query = "
            INSERT INTO {$table} ({$ancestorKey}, {$descendantKey}, {$depthKey})
            VALUES ({$key}, {$key}, 0)
        ";

        return DB::insert($query);
    }

    /**
     * Make a node a descendant of another ancestor or makes it a root node.
     *
     * @param int $ancestorId
     * @return void
     */
    public function moveNodeTo($ancestorId)
    {
        // Before moving, delete the subtree.
        $this->deleteNode($ancestorId);


    }

    protected function deleteNode($ancestorId)
    {
        $table = $this->getAdjacentTable();
        $ancestorKey = $this->getAncestorKey();
        $descendantKey = $this->getDescendantKey();
        $depthKey = $this->getDepthKey();
        "
        -- DELETE FROM $table
        -- JOIN $table AS d ON a.descendant = d.descendant
        -- LEFT JOIN $table AS x
        -- ON x.ancestor = d.ancestor AND x.descendant = a.ancestor
        -- WHERE d.ancestor = 'D' AND x.ancestor IS NULL
        ";

        DB::table($table)
            ->join($table, $table.'.'.$descendantKey, '=', $table.'.'.$descendantKey)
            ->leftJoin($table, $table.'.'.$ancestorKey, '=', $table.'.'.$ancestorKey)
            ->where($table.'.'.$ancestorKey, $ancestorId)
            ->whereNull($table.'.'.$ancestorKey)
            ->delete();
    }
}
