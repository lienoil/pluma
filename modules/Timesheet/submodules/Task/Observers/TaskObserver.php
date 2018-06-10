<?php

namespace Task\Observers;

use Task\Models\Task;

class TaskObserver
{
    /**
     * Listen to the TaskObserver created event.
     *
     * @param  \Task\Models\Task  $resource
     * @return void
     */
    public function created(Task $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Task successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the TaskObserver updated event.
     *
     * @param  \Task\Models\Task  $resource
     * @return void
     */
    public function updated(Task $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Task successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the TaskObserver deleted event.
     *
     * @param  \Task\Models\Task  $resource
     * @return void
     */
    public function deleted(Task $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Task successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the TaskObserver restored event.
     *
     * @param  \Task\Models\Task  $resource
     * @return void
     */
    public function restored(Task $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Task successfully restored");
        session()->flash('type', 'success');
    }
}
