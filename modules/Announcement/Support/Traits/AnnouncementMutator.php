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
        //
    }

    /**
     * Formatted string of expires_at
     *
     * @return string
     */
    public function getPublishedAttribute()
    {
        return strtotime($this->published_at) > 1
                ? Carbon::createFromTimeStamp(strtotime($this->published_at))->diffForHumans()
                : 'No publishing date';
    }

    /**
     * Formatted string of expires_at
     *
     * @return string
     */
    public function getExpiredAttribute()
    {
        return strtotime($this->expired_at) > 1
                ? Carbon::createFromTimeStamp(strtotime($this->expired_at))->diffForHumans()
                : 'No Expiration';
    }

    /**
     * Gets the user's display name.
     *
     * @return string
     */
    public function getAuthorAttribute()
    {
        return $this->user->displayname;
    }

    /**
     * Gets the category name.
     *
     * @return string
     */
    public function getCategorynameAttribute()
    {
        return $this->category->name ?? '';
    }
}
