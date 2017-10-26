<?php

namespace Bookmark\Observers;

use Bookmark\Models\Bookmark;

class BookmarkObserver
{
    /**
     * Listen to the BookmarkObserver created event.
     *
     * @param  \Bookmark\Models\Bookmark  $resource
     * @return void
     */
    public function created(Bookmark $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Bookmark successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the BookmarkObserver updated event.
     *
     * @param  \Bookmark\Models\Bookmark  $resource
     * @return void
     */
    public function updated(Bookmark $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Bookmark successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the BookmarkObserver deleted event.
     *
     * @param  \Bookmark\Models\Bookmark  $resource
     * @return void
     */
    public function deleted(Bookmark $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Bookmark successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the BookmarkObserver restored event.
     *
     * @param  \Bookmark\Models\Bookmark  $resource
     * @return void
     */
    public function restored(Bookmark $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Bookmark successfully restored");
        session()->flash('type', 'success');
    }
}
