<?php

namespace Content\Support\Relations;

use Content\Models\Content;

trait BelongsToManyContents
{
    public function contents()
    {
        return $this->belongsToMany(Content::class)->withPivot('status', 'course_id');
    }
}
