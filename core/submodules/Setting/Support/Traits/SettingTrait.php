<?php

namespace Setting\Support\Traits;

trait SettingTrait
{
    /**
     * Search all given searchable columns.
     *
     * @param  Illuminate\Database\Eloquent\Builder $builder
     * @param  string  $key
     * @param  string  $default
     * @return Illuminate\Database\Eloquent\Model
     */
    public function setting($key, $default = "")
    {
        $query = $this->settings()->where('key', $key)->first();

        return is_null($query) ? $default : $query->value;
    }
}
