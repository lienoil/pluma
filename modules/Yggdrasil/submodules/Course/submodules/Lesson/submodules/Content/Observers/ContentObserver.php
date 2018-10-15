<?php

namespace Content\Observers;

use Content\Models\Content;

class ContentObserver
{
    /**
     * Listen to the Content created event.
     *
     * @param \Content\Models\Content $resource
     * @return void
     */
    public function created(Content $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Course successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Content updated event.
     *
     * @param \Content\Models\Content $resource
     * @return void
     */
    public function updated(Content $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Course successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Content deleted event.
     *
     * @param \Content\Models\Content $resource
     * @return void
     */
    public function deleted(Content $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Course successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Content restored event.
     *
     * @param \Content\Models\Content $resource
     * @return void
     */
    public function restored(Content $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Course successfully restored");
        session()->flash('type', 'success');
    }
}
