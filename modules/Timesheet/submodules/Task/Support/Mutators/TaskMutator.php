<?php

namespace Task\Support\Mutators;

trait TaskMutator
{
    /**
     * Get the pretty date of the created_at column.
     *
     * @return Date|string
     */
    public function getHourAttribute()
    {
        return date('H:i:s', strtotime($this->hours));
    }
}
