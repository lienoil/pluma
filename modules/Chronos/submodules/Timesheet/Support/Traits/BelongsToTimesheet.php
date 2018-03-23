<?php

namespace Timesheet\Support\Traits;

use Timesheet\Models\Timesheet;

trait BelongsToTimesheet
{
    /**
     * Gets the resource that belongs to timesheet.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function timesheet()
    {
        return $this->belongsTo(Timesheet::class);
    }
}
