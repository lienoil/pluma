<?php

namespace Category\Support\Traits;

use Category\Models\Category;

trait BelongsToCategory
{
    /**
     * Get the category that owns the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
