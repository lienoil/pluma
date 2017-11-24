<?php

namespace Page\Observers;

use Page\Models\Page;

class PageObserver
{
    /**
     * Listen to the PageObserver created event.
     *
     * @param  \Page\Models\Page  $resource
     * @return void
     */
    public function created(Page $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Page successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the PageObserver updated event.
     *
     * @param  \Page\Models\Page  $resource
     * @return void
     */
    public function updated(Page $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Page successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the PageObserver deleted event.
     *
     * @param  \Page\Models\Page  $resource
     * @return void
     */
    public function deleted(Page $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Page successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the PageObserver restored event.
     *
     * @param  \Page\Models\Page  $resource
     * @return void
     */
    public function restored(Page $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Page successfully restored");
        session()->flash('type', 'success');
    }
}
