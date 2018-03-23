<?php

namespace Note\Observers;

use Note\Models\Note;

class NoteObserver
{
    /**
     * Listen to the NoteObserver created event.
     *
     * @param  \Note\Models\Note  $resource
     * @return void
     */
    public function created(Note $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Note successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the NoteObserver updated event.
     *
     * @param  \Note\Models\Note  $resource
     * @return void
     */
    public function updated(Note $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Note successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the NoteObserver deleted event.
     *
     * @param  \Note\Models\Note  $resource
     * @return void
     */
    public function deleted(Note $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Note successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the NoteObserver restored event.
     *
     * @param  \Note\Models\Note  $resource
     * @return void
     */
    public function restored(Note $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Note successfully restored");
        session()->flash('type', 'success');
    }
}
