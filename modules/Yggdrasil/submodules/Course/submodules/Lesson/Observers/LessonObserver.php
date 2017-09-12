<?php

namespace Lesson\Observers;

use Lesson\Models\Lesson;

class LessonObserver
{
    /**
     * Listen to the LessonObserver created event.
     *
     * @param  \Lesson\Models\Lesson  $resource
     * @return void
     */
    public function created(Lesson $resource)
    {
        // save fields
        session()->flash('title', $resource->title);
        session()->flash('message', "Lesson successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the LessonObserver updated event.
     *
     * @param  \Lesson\Models\Lesson  $resource
     * @return void
     */
    public function updated(Lesson $resource)
    {
        session()->flash('title', $resource->title);
        session()->flash('message', "Lesson successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the LessonObserver deleted event.
     *
     * @param  \Lesson\Models\Lesson  $resource
     * @return void
     */
    public function deleted(Lesson $resource)
    {
        session()->flash('title', $resource->title);
        session()->flash('message', "Lesson successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the LessonObserver restored event.
     *
     * @param  \Lesson\Models\Lesson  $resource
     * @return void
     */
    public function restored(Lesson $resource)
    {
        session()->flash('title', $resource->title);
        session()->flash('message', "Lesson successfully restored");
        session()->flash('type', 'success');
    }
}
