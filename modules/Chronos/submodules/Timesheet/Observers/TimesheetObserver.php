<?php

namespace Timesheet\Observers;

use Timesheet\Models\Timesheet;

class TimesheetObserver
{
    /**
     * Listen to the TimesheetObserver created event.
     *
     * @param  \Timesheet\Models\Timesheet  $resource
     * @return void
     */
    public function created(Timesheet $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Timesheet successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the TimesheetObserver updated event.
     *
     * @param  \Timesheet\Models\Timesheet  $resource
     * @return void
     */
    public function updated(Timesheet $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Timesheet successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the TimesheetObserver deleted event.
     *
     * @param  \Timesheet\Models\Timesheet  $resource
     * @return void
     */
    public function deleted(Timesheet $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Timesheet successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the TimesheetObserver restored event.
     *
     * @param  \Timesheet\Models\Timesheet  $resource
     * @return void
     */
    public function restored(Timesheet $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Timesheet successfully restored");
        session()->flash('type', 'success');
    }
}
