<?php

namespace Category\Support\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CategoryMutators
{
    /**
     * Gets all categories via given category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  string  $category
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeType(Builder $builder, $category)
    {
        return $builder->where('categorable_type', $category);
    }

    /**
     * Gets the categorable name of the resource.
     *
     * @return string
     */
    public static function categorable()
    {
        $intance = new static;

        return isset($instance->categorable) ? $instance->categorable : $intance->getTable();
    }
}
