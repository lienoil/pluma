<?php

namespace Content\Support\Relations;

use Content\Models\Content;

trait BelongsToManyContents
{
    /**
     * Gets all Content resources associated
     * with this model.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function contents()
    {
        return $this->belongsToMany(Content::class)->withPivot('status', 'course_id');
    }
}
