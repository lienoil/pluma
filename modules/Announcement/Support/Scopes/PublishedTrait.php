<?php

namespace Announcement\Support\Scopes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait PublishedTrait
{
    /**
     * get all published resources.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    public function scopePublished(Builder $builder)
    {
        return $builder->where('published_at', '<=', Carbon::now()->toDateTimeString());
    }
}
