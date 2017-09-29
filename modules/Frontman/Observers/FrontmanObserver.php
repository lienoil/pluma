<?php

namespace Frontman\Observers;

use Frontman\Models\Frontman;

class FrontmanObserver
{
    /**
     * Listen to the FrontmanObserver created event.
     *
     * @param  \Frontman\Models\Frontman  $resource
     * @return void
     */
    public function created(Frontman $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Frontman successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the FrontmanObserver updated event.
     *
     * @param  \Frontman\Models\Frontman  $resource
     * @return void
     */
    public function updated(Frontman $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Frontman successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the FrontmanObserver deleted event.
     *
     * @param  \Frontman\Models\Frontman  $resource
     * @return void
     */
    public function deleted(Frontman $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Frontman successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the FrontmanObserver restored event.
     *
     * @param  \Frontman\Models\Frontman  $resource
     * @return void
     */
    public function restored(Frontman $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Frontman successfully restored");
        session()->flash('type', 'success');
    }
}
