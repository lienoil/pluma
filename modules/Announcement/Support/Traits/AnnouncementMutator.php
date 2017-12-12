<?php

namespace Announcement\Support\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

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
     * get all published resources.
     *
     * @param  \Illuminate\Database\Query\Builder $builder
     * @return void
     */
    public function scopePublished(Builder $builder)
    {
        $builder->where('published_at', '<=', Carbon::now()->toDateTimeString());
    }

    /**
     * Formatted string of starts_at
     *
     * @return string
     */
    public function getPublishedAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->published_at))->diffForHumans();
    }

    /**
     * Formatted string of expires_at
     *
     * @return string
     */
    public function getExpiredAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->expired_at))->diffForHumans();
    }
}
