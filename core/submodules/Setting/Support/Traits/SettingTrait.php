<?php

namespace Setting\Support\Traits;

trait SettingTrait
{
    /**
     * Get the setting value from the given key.
     *
     * @param  string  $key
     * @param  string  $default
     * @return mixed
     */
    public function setting($key, $default = "")
    {
        $query = $this->settings()->where('key', $key)->first();

        return is_null($query) ? $default : $query->value;
    }
}
