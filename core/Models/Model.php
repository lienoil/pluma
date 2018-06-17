<?php

namespace Pluma\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Pluma\Scopes\ExceptScope;
use Pluma\Support\Cache\Scopes\CachedScope;
use Pluma\Support\Database\Scopes\ExceptableTrait;
use Pluma\Support\Database\Scopes\SearchableTrait;
use Pluma\Support\Database\Traits\BaseRelations;
use Pluma\Support\Mutators\BaseMutator;

class Model extends BaseModel
{
    use BaseMutator,
        BaseRelations,
        CachedScope,
        ExceptableTrait,
        SearchableTrait;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setPerPage(settings('items_per_page', $this->perPage));
    }

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // For observer events
        Model::setEventDispatcher(app('events'));
    }

    /**
     * Get the default ancestor key name for the model.
     *
     * @return string
     */
    public function getAncestorKey()
    {
        return $this->ancestorKey ?? 'ancestor';
    }

    /**
     * Get the default descendant key name for the model.
     *
     * @return string
     */
    public function getDescendantKey()
    {
        return $this->ancestorKey ?? 'descendant';
    }

    /**
     * Get the default adjacent table name for the model.
     *
     * @return string
     */
    public function getAdjacentTableName()
    {
        return $this->adjacentTable ?? $this->getTable().'tree';
    }
}
