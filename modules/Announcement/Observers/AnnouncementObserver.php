<?php

namespace Announcement\Observers;

use Announcement\Models\Announcement;

class AnnouncementObserver
{
    /**
     * Listen to the Announcement created event.
     *
     * @param  \Announcement\Models\Announcement  $resource
     * @return void
     */
    public function created(Announcement $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Announcement successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Announcement updated event.
     *
     * @param  \Announcement\Models\Announcement  $resource
     * @return void
     */
    public function updated(Announcement $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Announcement successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Announcement deleted event.
     *
     * @param  \Announcement\Models\Announcement  $resource
     * @return void
     */
    public function deleted(Announcement $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Announcement successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Announcement restored event.
     *
     * @param  \Announcement\Models\Announcement  $resource
     * @return void
     */
    public function restored(Announcement $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Announcement successfully restored");
        session()->flash('type', 'success');
    }
}
