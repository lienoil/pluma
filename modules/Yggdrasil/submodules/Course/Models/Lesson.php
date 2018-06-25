<?php

namespace Course\Models;

use Course\Support\Relations\BelongsToCourse;
use Course\Support\Scopes\OrderBySortScope;
use Pluma\Support\Database\Adjacency\Relation\Model as AdjacentModel;

class Lesson extends AdjacentModel
{
    use BelongsToCourse;

    protected $adjacentTable = 'lessonstree';

    protected $fillable = ['title', 'slug', 'code', 'feature', 'body'];

    protected $searchables = ['created_at', 'updated_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrderBySortScope);
    }
}
