<?php

namespace Note\Support\Relations;

use Note\Models\Note;

trait HasManyNotes
{
    /**
     * Gets the resources that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
