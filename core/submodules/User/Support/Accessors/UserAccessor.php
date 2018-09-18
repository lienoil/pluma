<?php

namespace User\Support\Accessors;

use Laravolt\Avatar\Avatar;

trait UserAccessor
{
    /**
     * Retrieve the mutated avatar value.
     *
     * @return string
     */
    public function getPhotoAttribute()
    {
        if ($this->avatar) {
            return $this->avatar;
        }

        return cache()->remember('cached::avatar#'.$this->id, 120, function () {
            $avatar = new Avatar(config('avatar'));
            return $avatar->create($this->fullname)->toBase64()->getEncoded();
        });
    }

    /**
     * Retrieves the mutated crumb field.
     *
     * @return string
     */
    public function getCrumbAttribute()
    {
        return $this->fullname;
    }
}
