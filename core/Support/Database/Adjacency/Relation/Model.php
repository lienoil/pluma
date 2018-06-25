<?php

namespace Pluma\Support\Database\Adjacency\Relation;

use Illuminate\Database\Eloquent\Model as Eloquent;
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
     * Get the short name of the "ancestor" column.
     *
     * @return string
     */
    public function getAncestorColumn()
    {
        return $this->ancestorKey;
    }

    /**
     * Get the short name of the "descendant" column.
     *
     * @return string
     */
    public function getDescendantColumn()
    {
        return $this->descendantKey;
    }

    /**
     * Get the short name of the "depth" column.
     *
     * @return string
     */
    public function getDepthColumn()
    {
        return $this->depthKey;
    }

    /**
     * Inserts new node into closure table.
     *
     * @param int $ancestorId
     * @param int $descendantId
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function insertNode($ancestorId, $descendantId)
    {
        $table = $this->getAdjacentTable();
        $ancestor = $this->getAncestorColumn();
        $descendant = $this->getDescendantColumn();
        $depth = $this->getDepthColumn();

        $query = "
            INSERT INTO {$table} ({$ancestor}, {$descendant}, {$depth})
            SELECT tbl.{$ancestor}, {$descendantId}, tbl.{$depth}+1
            FROM {$table} AS tbl
            WHERE tbl.{$descendant} = {$ancestorId}
            UNION ALL
            SELECT {$descendantId}, {$descendantId}, 0
        ";

        // DB::table($table)
        //   ->insert([$ancestor, $descendant, $depth])
        //   ->select([$ancestor, $descendant, $depth])->statement($query);
    }

    /**
     * Make a node a descendant of another ancestor or makes it a root node.
     *
     * @param int $ancestorId
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function moveNodeTo($ancestorId = null) {}
}
