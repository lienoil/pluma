<?php

namespace Task\Support\Relations;

use Role\Models\Role;
use Task\Models\Task;

trait BelongsToManyTasks
{
    /**
     * Retrieves the resources that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
