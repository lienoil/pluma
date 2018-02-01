<?php

namespace Note\Support\Relations;

use Note\Models\Note;

trait BelongsToManyNotes
{
    /**
     * Get the notes that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function notes()
    {
        return $this->belongsToMany(Note::class);
    }
}
