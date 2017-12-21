<?php

namespace Pluma\Support\Database\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait SlugOrFail
{

    /**
     * Limit the query by the slug equal to the given value.
     *
     * @param  Illuminate\Database\Eloquent\Builder
     * @param  string   $slug
     * @return Model
     */
    public function scopeSlugOrFail(Builder $builder, $slug)
    {
        return $builder->where('slug', $slug)->firstOrFail();
    }

    /**
     * Limit the query by the code equal to the given value.
     *
     * @param  Illuminate\Database\Eloquent\Builder
     * @param  string   $code
     * @return Model
     */
    public function scopeCodeOrFail(Builder $builder, $code)
    {
        return $builder->where('code', $code)->firstOrFail();
    }
}
