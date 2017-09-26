<?php

namespace Pluma\Support\Mutators;

use Illuminate\Support\Str;

trait BaseMutator
{
    /**
     * The limit to generate excerpts.
     *
     * @var integer
     */
    protected $wordCount = 30;

    /**
     * Get the pretty date of the created_at column.
     *
     * @return Date|string
     */
    public function getCreatedAttribute()
    {
        return date(config('settings.date_format', 'F d, Y \(h:iA\)'), strtotime($this->created_at));
    }

    /**
     * Get the pretty date of the updated_at column.
     *
     * @return Date|string
     */
    public function getModifiedAttribute()
    {
        return date(config('settings.date_format', 'F d, Y \(h:iA\)'), strtotime($this->updated_at));
    }

    /**
     * Get the pretty date of the deleted_at column.
     *
     * @return Date|string
     */
    public function getRemovedAttribute()
    {
        return date(config('settings.date_format', 'F d, Y \(h:iA\)'), strtotime($this->deleted_at));
    }

    /**
     * Mutate the body or description to excerpt.
     *
     * @return string
     */
    public function getExcerptAttribute()
    {
        $blurb = $this->body ? $this->body : $this->description;

        return Str::words($blurb, $this->wordCount);
    }

    public function scopeExplode($key)
    {
        $words = [];

        foreach ($this->{$key} as $value) {
            $words[] = $value;
        }

        return explode(" / ", $words);
    }
}
