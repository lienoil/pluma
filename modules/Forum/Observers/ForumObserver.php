<?php

namespace Forum\Observers;

use Forum\Models\Forum;

class ForumObserver
{
    /**
     * Listen to the Forum created event.
     *
     * @param  \Forum\Models\Forum  $resource
     * @return void
     */
    public function created(Forum $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Forum successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Forum updated event.
     *
     * @param  \Forum\Models\Forum  $resource
     * @return void
     */
    public function updated(Forum $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Forum successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Forum deleted event.
     *
     * @param  \Forum\Models\Forum  $resource
     * @return void
     */
    public function deleted(Forum $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Forum successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Forum restored event.
     *
     * @param  \Forum\Models\Forum  $resource
     * @return void
     */
    public function restored(Forum $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Forum successfully restored");
        session()->flash('type', 'success');
    }
}
