<?php

namespace Course\Models;

use Course\Support\Relations\BelongsToCourse;
use Course\Support\Scopes\OrderBySortScope;
use Pluma\Models\Model;
use Support\Database\Traits\AdjacentlyRelatedToSelf;

class Lesson extends Model
{
    use BelongsToCourse,
        AdjacentlyRelatedToSelf;

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
