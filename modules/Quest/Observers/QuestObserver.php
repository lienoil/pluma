<?php

namespace Quest\Observers;

use Quest\Models\Quest;

class QuestObserver
{
    /**
     * Listen to the QuestObserver created event.
     *
     * @param  \Quest\Models\Quest  $resource
     * @return void
     */
    public function created(Quest $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Quest successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the QuestObserver updated event.
     *
     * @param  \Quest\Models\Quest  $resource
     * @return void
     */
    public function updated(Quest $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Quest successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the QuestObserver deleted event.
     *
     * @param  \Quest\Models\Quest  $resource
     * @return void
     */
    public function deleted(Quest $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Quest successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the QuestObserver restored event.
     *
     * @param  \Quest\Models\Quest  $resource
     * @return void
     */
    public function restored(Quest $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Quest successfully restored");
        session()->flash('type', 'success');
    }
}
