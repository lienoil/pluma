<?php

namespace Pluma\Support\Database\Scopes;

trait Exceptable
{
    /**
     * Exclude the given from the resource.
     *
     * @param  \Illuminate\Database\Query\Builder $builder
     * @param  mixed $ommitables
     * @param  string $column
     * @return $builder
     */
    public function scopeExcept($builder, $ommitables = [], $column = "code")
    {
        return $builder->whereNotIn($column, (array) $ommitables);
    }

    /**
     * Alias of except.
     *
     * @param  \Illuminate\Database\Query\Builder $builder
     * @param  mixed $ommitables
     * @param  string $column
     * @return $builder
     */
    public function scopeOmmit($builder, $ommitables = [], $column = "code")
    {
        return $this->except($builder, (array) $ommitables, $column);
    }
}
