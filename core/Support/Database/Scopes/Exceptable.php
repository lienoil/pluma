<?php

namespace Pluma\Support\Database\Scopes;

trait Exceptable
{
    /**
     * Exclude the given from the resource.
     *
     * @param  \Illuminate\Database\Query\Builder $builder
     * @param  mixed $search
     * @param  string $column
     * @return $builder
     */
    public function scopeExcept($builder, $except = [], $column = "code")
    {
        if (auth()->user()->isRoot()) return $builder;

        // Merge $params to $rootroles
        $this->setRootRoles($except);
        dd($this->rootroles());
        return $builder->whereNotIn($column, $this->rootroles());
    }
}
