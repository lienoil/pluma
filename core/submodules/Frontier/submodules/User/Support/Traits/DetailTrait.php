<?php

namespace User\Support\Traits;

trait DetailTrait
{
    /**
     * Query from given key.
     *
     * @param  string  $key
     * @param  string  $default
     * @return string
     */
    public function detail($key, $default = "")
    {
        $query = $this->details()->where('key', $key)->first();

        return is_null($query) ? $default : $query->value;
    }
}
