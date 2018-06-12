<?php

namespace Timesheet\Support\Relations;

use Timesheet\Models\Timesheet;

trait BelongsToManyTimesheets
{
    /**
     * Retrieves the belonging resource for this model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function timesheets()
    {
        return $this->belongsToMany(Timesheet::class);
    }
}
