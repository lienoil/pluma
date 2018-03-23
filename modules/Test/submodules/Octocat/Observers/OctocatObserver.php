<?php

namespace Octocat\Observers;

use Octocat\Models\Octocat;

class OctocatObserver
{
    /**
     * Listen to the OctocatObserver created event.
     *
     * @param  \Octocat\Models\Octocat  $resource
     * @return void
     */
    public function created(Octocat $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Octocat successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the OctocatObserver updated event.
     *
     * @param  \Octocat\Models\Octocat  $resource
     * @return void
     */
    public function updated(Octocat $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Octocat successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the OctocatObserver deleted event.
     *
     * @param  \Octocat\Models\Octocat  $resource
     * @return void
     */
    public function deleted(Octocat $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Octocat successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the OctocatObserver restored event.
     *
     * @param  \Octocat\Models\Octocat  $resource
     * @return void
     */
    public function restored(Octocat $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Octocat successfully restored");
        session()->flash('type', 'success');
    }
}
