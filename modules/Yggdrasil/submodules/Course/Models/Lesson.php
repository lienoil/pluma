<?php

namespace Course\Models;

use Course\Support\Relations\BelongsToCourse;
use Course\Support\Relations\HasManyLessons;
use Course\Support\Scopes\OrderBySortScope;
use Pluma\Support\Database\Adjacency\Model as AdjacencyModel;

class Lesson extends AdjacencyModel
{
    use BelongsToCourse;

    protected $table = 'lessons';

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
