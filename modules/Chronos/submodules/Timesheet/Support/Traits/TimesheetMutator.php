<?php

namespace Timesheet\Support\Traits;

use Illuminate\Database\Eloquent\Builder;

trait TimesheetMutator
{
    /**
     * Get all resource that belongs to the specified user_id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeBelongsToUser(Builder $builder, $id)
    {
        return $builder->where('user_id', $id);
    }
}
