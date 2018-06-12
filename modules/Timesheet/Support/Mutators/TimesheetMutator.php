<?php

namespace Timesheet\Support\Mutators;

trait TimesheetMutator
{
    /**
     * Get the pretty date of the created_at column.
     *
     * @return Date|string
     */
    public function getDaynameAttribute()
    {
        return date('D', strtotime("Sunday +{$this->day} days"));
    }

    /**
     * Retrieves the mutated date value.
     *
     * @return string
     */
    public function getDatedAttribute()
    {
        return date('D M d, Y', strtotime($this->date));
    }

    /**
     * Retrieves the mutated date value.
     *
     * @return string
     */
    public function getInAttribute()
    {
        return date('F d, Y', strtotime($this->timein));
    }
}
