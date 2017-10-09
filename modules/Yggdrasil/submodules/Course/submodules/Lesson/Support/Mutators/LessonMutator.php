<?php

namespace Lesson\Support\Mutators;

trait LessonMutator
{
    /**
     * Get the contents count
     *
     * @return string
     */
    public function getContentsCountAttribute()
    {
        return $this->contents->count() . ' ' .
            ($this->contents->count() > 1 ? __('Contents') : __('Content'));
    }

    /**
     * Gets the progress of user in percentage.
     *
     * @return int
     */
    public function getProgressAttribute()
    {
        return 0;
    }

    /**
     * Gets the progress of user in percentage.
     *
     * @return string
     */
    public function getCompletedAttribute()
    {
        // if ($this->contents) {
            // return $this->contents->count();
        // }

        return 0;
    }

    /**
     * Gets the dialog model.
     *
     * @return boolean
     */
    public function getDialogAttribute()
    {
        return false;
    }
}
