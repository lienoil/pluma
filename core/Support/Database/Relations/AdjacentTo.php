<?php

namespace Pluma\Support\Database\Relations;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class AdjacentTo extends Relation
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The intermediate table for the relation.
     *
     * @var string
     */
    protected $table;

    /**
     * The ancestor key for the relation.
     *
     * @var string
     */
    protected $ancestorKey;

    /**
     * The descendant key for the relation.
     *
     * @var string
     */
    protected $descendantKey;

    /**
     * The length key for the relation.
     *
     * @var string
     */
    protected $lengthKey = 'length';

    /**
     * Create a new belongs to relationship instance.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Database\Eloquent\Model    $parent
     * @param  string  $table
     * @param  string  $ancestorKey
     * @param  string  $descendantKey
     * @return void
     */
    public function __construct(Builder $query, Model $parent, $table, $ancestorKey, $descendantKey)
    {
        $this->model = $query->getModel();
        $this->table = $table;
        $this->ancestorKey = $ancestorKey;
        $this->descendantKey = $descendantKey;

        parent::__construct($query, $parent);
    }

    /**
     * Set the base constraints on the relation query.
     *
     * @return void
     */
    public function addConstraints() {}

    /**
     * Set the join clause for the relation query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder|null  $query
     * @return $this
     */
    public function performAncestorJoin($query = null)
    {
        $query = $query ?: $this->query;

        $key = $this->model->getQualifiedKeyName();

        $query
            ->join(
                $this->table, $key, '=', $this->getQualifiedAncestorKeyName()
            )
            ->where(
                $this->getQualifiedDescendantKeyName(),
                $this->model->{$this->model->getKeyName()}
            );

        return $this;
    }

    /**
     * Set the join clause for the relation query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder|null  $query
     * @return $this
     */
    public function performDescendantJoin($query = null)
    {
        $query = $query ?: $this->query;

        $key = $this->model->getQualifiedKeyName();

        $query
            ->join(
                $this->table, $key, '=', $this->getQualifiedDescendantKeyName()
            )
            ->where(
                $this->getQualifiedAncestorKeyName(),
                $this->model->{$this->model->getKeyName()}
            );

        return $this;
    }

    /**
     * Set the constraints for an eager load of the relation.
     *
     * @param  array  $models
     * @return void
     */
    public function addEagerConstraints(array $models) {}

    /**
     * Initialize the relation on a set of models.
     *
     * @param  array   $models
     * @param  string  $relation
     * @return array
     */
    public function initRelation(array $models, $relation) {}

    /**
     * Match the eagerly loaded results to their parents.
     *
     * @param  array   $models
     * @param  \Illuminate\Database\Eloquent\Collection  $results
     * @param  string  $relation
     * @return array
     */
    public function match(array $models, Collection $results, $relation) {}

    /**
     * Get the results of the relationship.
     *
     * @return mixed
     */
    public function getResults() {}

    /**
     * Get the fully qualified "ancestor key" for the relation.
     *
     * @return string
     */
    public function getQualifiedAncestorKeyName()
    {
        return $this->table.'.'.$this->ancestorKey;
    }

    /**
     * Get the fully qualified "descendant key" for the relation.
     *
     * @return string
     */
    public function getQualifiedDescendantKeyName()
    {
        return $this->table.'.'.$this->descendantKey;
    }

    /**
     * Get the fully qualified "descendant key" for the relation.
     *
     * @return string
     */
    public function getQualifiedLengthKeyName()
    {
        return $this->table.'.'.$this->lengthKey;
    }

    /**
     * Retrieves the child nodes of the given resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function descendants()
    {
        $this->performDescendantJoin();

        return $this->get();
    }

    /**
     * Retrieves the immediate children of the given resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function children()
    {
        $this->performDescendantJoin();

        return $this->where($this->getQualifiedLengthKeyName(),  1)->get();
    }

    /**
     * Retrieves the parent nodes of the given resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function ancestors()
    {
        $this->performAncestorJoin();

        return $this->get();
    }

    /**
     * Retrieve the immediate parent of the given resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function parent()
    {
        $this->performAncestorJoin();

        return $this->where($this->getQualifiedLengthKeyName(), 1)->first();
    }

    public function root()
    {
        $key = $this->model->getQualifiedKeyName();

        return $this->join(
                $this->table, $key, '=', $this->getQualifiedAncestorKeyName()
            )
            ->where($this->getQualifiedLengthKeyName(), 1)
            ->get();
    }
}
