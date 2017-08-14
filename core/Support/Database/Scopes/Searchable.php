<?php

namespace Pluma\Support\Database\Scopes;

trait Searchable
{
    /**
     * Array of searchable columns.
     *
     * @var array
     */
    protected $searchables = [];

    /**
     * Search all given searchable columns
     *
     * @return $query
     */
    public function scopeSearch($query, $search = "")
    {
        if (empty($search)) {
            return $query;
        }

        foreach ($this->searchables as $searchable) {
            $query->orWhere($searchable, 'LIKE', "%{$search}%");
        }

        return $query;
    }
}
