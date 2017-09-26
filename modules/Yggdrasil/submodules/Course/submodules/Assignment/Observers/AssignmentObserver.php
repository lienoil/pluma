<?php

namespace Assignment\Observers;

use Assignment\Models\Assignment;

class AssignmentObserver
{
    /**
     * Listen to the AssignmentObserver created event.
     *
     * @param  \Assignment\Models\Assignment  $resource
     * @return void
     */
    public function created(Assignment $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Assignment successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the AssignmentObserver updated event.
     *
     * @param  \Assignment\Models\Assignment  $resource
     * @return void
     */
    public function updated(Assignment $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Assignment successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the AssignmentObserver deleted event.
     *
     * @param  \Assignment\Models\Assignment  $resource
     * @return void
     */
    public function deleted(Assignment $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Assignment successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the AssignmentObserver restored event.
     *
     * @param  \Assignment\Models\Assignment  $resource
     * @return void
     */
    public function restored(Assignment $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Assignment successfully restored");
        session()->flash('type', 'success');
    }
}
