<?php

namespace Setting\Support\Traits;

trait Keyable
{
    /**
     * Turns a column's value into a key.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  string $key
     * @param  string $value
     * @return Object
     */
    public function scopeKey($builder, $key = 'key', $value = 'value')
    {
        $resources = $builder->get();
        $d = [];
        foreach ($resources as $resource) {
            $d[$resource->{$key}] = $resource->{$value};
        }

        return json_decode(json_encode($d));
    }
}
