<?php

namespace Timesheet\Support\Traits;

use Timesheet\Models\Daily;

trait HasManyDailies
{
    /**
     * Gets the resources that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function dailies()
    {
        return $this->hasMany(Daily::class);
    }
}
