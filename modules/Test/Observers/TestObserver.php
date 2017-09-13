<?php

namespace Test\Observers;

use Test\Models\Test;

class TestObserver
{
    /**
     * Listen to the TestObserver created event.
     *
     * @param  \Test\Models\Test  $resource
     * @return void
     */
    public function created(Test $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Test successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the TestObserver updated event.
     *
     * @param  \Test\Models\Test  $resource
     * @return void
     */
    public function updated(Test $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Test successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the TestObserver deleted event.
     *
     * @param  \Test\Models\Test  $resource
     * @return void
     */
    public function deleted(Test $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Test successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the TestObserver restored event.
     *
     * @param  \Test\Models\Test  $resource
     * @return void
     */
    public function restored(Test $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Test successfully restored");
        session()->flash('type', 'success');
    }
}
