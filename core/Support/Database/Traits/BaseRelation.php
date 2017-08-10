<?php

namespace Support\Database\Traits;

use Support\Database\Relations\BelongsToManyThrough;
use Support\Database\Relations\HasManyToManyThrough;

trait BaseRelation
{
    /**
     * Gets the Belonging resource through a pivot.
     *
     * @param  Model $related
     * @param  Model $through
     * @param  string $firstKey
     * @param  string $secondKey
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function belongsToManyThrough($related, $through, $firstKey = null, $secondKey = null)
    {
        $through = new $through;
        $related = new $related;

        $firstKey  = $firstKey ?: $this->getForeignKey();
        $secondKey = $secondKey ?: $related->getForeignKey();

        return new BelongsToManyThrough($related->newQuery(), $this, $through, $firstKey, $secondKey);
    }

    public function hasManyToManyThrough($related, $through, $firstKey = null, $secondKey = null)
    {
        $through = new $through;
        $related = new $related;

        $firstKey  = $firstKey ?: $this->getForeignKey();
        $secondKey = $secondKey ?: $related->getForeignKey();

        return new HasManyToManyThrough($related->newQuery(), $this, $through, $firstKey, $secondKey);
    }
}
