<?php

namespace Page\Support\Mutators;

use Closure;
use Parchment\Helpers\Word;

trait PageMutator
{
    /**
     * Retrieve the user's displayname.
     *
     * @return string
     */
    public function getAuthorAttribute()
    {
        return ! $this->user ?: $this->user->displayname;
    }

    /**
     * Retrieve the author's profile picture.
     *
     * @return string
     */
    public function getProfileAttribute()
    {
        return ! $this->user ?: $this->user->photo;
    }

    /**
     * Get the pretty date of the created_at column.
     *
     * @return Date|string
     */
    public function getCreatedAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(); //date(config('settings.date_format', 'F d, Y \(h:iA\)'), strtotime($this->created_at));
    }

    /**
     * Get the pretty date of the updated_at column.
     *
     * @return Date|string
     */
    public function getModifiedAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->updated_at))->diffForHumans(); // date(config('settings.date_format', 'F d, Y \(h:iA\)'), strtotime($this->updated_at));
    }
}
