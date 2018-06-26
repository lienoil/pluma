<?php

namespace Pluma\Support\Database\Adjacency\Relation;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Pluma\Support\Database\Adjacency\Relation\Contracts\AdjacencyRelationModelInterface;
use Pluma\Support\Database\Adjacency\Relation\Scopes\GroupByRootScope;
use Pluma\Support\Database\Adjacency\Relation\Traits\AdjacentlyRelatedToSelf;
use Pluma\Support\Database\Adjacency\Relation\Traits\BaseAdjacencyRelationTrait;

class Model extends Eloquent implements AdjacencyRelationModelInterface
{
    use BaseAdjacencyRelationTrait,
        AdjacentlyRelatedToSelf;

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
     * The ancestor key for the relation.
     *
     * @var string
     */
    protected $ancestorKey = 'ancestor_id';

    /**
     * The descendant key for the relation.
     *
     * @var string
     */
    protected $descendantKey = 'descendant_id';

    /**
     * The depth key for the relation.
     *
     * @var string
     */
    protected $depthKey = 'depth';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

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
        $ancestor = $this->getAncestorKey();
        $descendant = $this->getDescendantKey();
        $descendantId = $this->getKey();
        $depth = $this->getDepthKey();

        $query = "
            INSERT INTO {$table} ({$ancestor}, {$descendant}, {$depth})
            SELECT tbl.{$ancestor}, {$descendantId}, tbl.{$depth}+1
            FROM {$table} AS tbl
            WHERE tbl.{$descendant} = {$ancestorId}
            UNION ALL
            SELECT {$descendantId}, {$descendantId}, 0
            -- ON DUPLICATE KEY UPDATE {$depth} = VALUES ({$depth})
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
    public function moveNodeTo($ancestorId = null)
    {
        // Before moving, delete the subtree.
        $this->deleteNode($ancestorId);


    }

    public function deleteNode($ancestorId)
    {
        $table = $this->getAdjacentTable();
        $ancestorKey = $this->getAncestorKey();
        $descendantKey = $this->getDescendantKey();
        $depthKey = $this->getDepthKey();

        "
        DELETE FROM $table
        JOIN $table AS d ON a.descendant = d.descendant
        LEFT JOIN $table AS x
        ON x.ancestor = d.ancestor AND x.descendant = a.ancestor
        WHERE d.ancestor = 'D' AND x.ancestor IS NULL;
        ";

        DB::table($table)
            ->join($table, $table.'.'.$descendantKey, '=', $table.'.'.$descendantKey)
            ->leftJoin($table, $table.'.'.$ancestorKey, '=', $table.'.'.$ancestorKey)
            ->whereIn($descendantKey, function ($query) use ($descendantKey, $table, $ancestorKey, $ancestorId) {
                $query->select($descendantKey)
                    ->from($table)
                    ->where($ancestorKey, $ancestorId);
            })
            ->whereNotIn($ancestorKey, function ($query) use ($descendantKey, $table, $ancestorKey, $ancestorId) {
                $query->select($descendantKey)
                    ->from($table)
                    ->where($ancestorKey, $ancestorId);
            })
            ->delete();
    }
}
