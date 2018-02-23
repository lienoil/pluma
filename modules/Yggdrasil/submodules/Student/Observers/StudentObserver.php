<?php

namespace Student\Observers;

use Student\Models\Student;

class StudentObserver
{
    /**
     * Listen to the StudentObserver created event.
     *
     * @param  \Student\Models\Student  $resource
     * @return void
     */
    public function created(Student $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Student successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the StudentObserver updated event.
     *
     * @param  \Student\Models\Student  $resource
     * @return void
     */
    public function updated(Student $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Student successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the StudentObserver deleted event.
     *
     * @param  \Student\Models\Student  $resource
     * @return void
     */
    public function deleted(Student $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Student successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the StudentObserver restored event.
     *
     * @param  \Student\Models\Student  $resource
     * @return void
     */
    public function restored(Student $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Student successfully restored");
        session()->flash('type', 'success');
    }
}
