<?php

namespace Content\Observers;

use Content\Models\Content;

class ContentObserver
{
    /**
     * Listen to the ContentObserver created event.
     *
     * @param  \Content\Models\Content  $resource
     * @return void
     */
    public function created(Content $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Content successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the ContentObserver updated event.
     *
     * @param  \Content\Models\Content  $resource
     * @return void
     */
    public function updated(Content $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Content successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the ContentObserver deleted event.
     *
     * @param  \Content\Models\Content  $resource
     * @return void
     */
    public function deleted(Content $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Content successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the ContentObserver restored event.
     *
     * @param  \Content\Models\Content  $resource
     * @return void
     */
    public function restored(Content $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Content successfully restored");
        session()->flash('type', 'success');
    }
}
