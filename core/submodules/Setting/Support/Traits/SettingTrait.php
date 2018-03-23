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
        $query = $this->settings()
                  ? $this->settings()->where('key', $key)->first()
                  : null;

        return is_null($query) ? $default : $query->value;
    }
}
