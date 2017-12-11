<?php

namespace Announcement\Support\Traits;

use Carbon\Carbon;

trait AnnouncementMutator
{
    /**
     * Announce the given resource.
     *
     * @param  int $id
     * @return void
     */
    public static function publish($id = null)
    {
        $instance = (new static);
        // $announcement = $instance->find($id);

        // session()->flash("announcements", $announcement->toArray());
    }

    /**
     * Formatted string of starts_at
     *
     * @return string
     */
    public function getStartsAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->starts_at))->diffForHumans();
    }

    /**
     * Formatted string of expires_at
     *
     * @return string
     */
    public function getExpiresAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->expires_at))->diffForHumans();
    }
}
