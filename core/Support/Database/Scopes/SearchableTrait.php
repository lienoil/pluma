<?php

namespace Pluma\Support\Database\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

trait SearchableTrait
{
    /**
     * Array of searchable columns.
     *
     * @var array
     */
    protected $searchables = [];

    /**
     * Search all given searchable columns.
     *
     * @param  Illuminate\Database\Eloquent\Builder $builder
     * @param  mixed  $search
     * @return Illuminate\Database\Eloquent\Model
     */
    public function scopeSearch(Builder $builder, $search = null)
    {
        if (is_null($search)) {
            return $builder;
        }


        if (is_array($search)) {
            $this->setSearchables($search);

            foreach ($this->getSearchables() as $column => $value) {
                $builder->orWhere($column, 'LIKE', "%{$value}%");
            }

            return $builder;
        }

        foreach ($this->getSearchables() as $searchable) {
            $builder->orWhere($searchable, 'LIKE', "%{$search}%");
        }

        return $builder;
    }

    /**
     * Merge searchables columns and validate.
     *
     * @param array $searchables
     */
    protected function setSearchables($searchables)
    {
        $this->searchables = $searchables;

        foreach ($this->searchables as $column => $value) {
            if (! Schema::hasColumn($this->getTable(), $column)) {
                unset($this->searchables[$column]);
            }
        }
    }

    /**
     * Get the array of searchable columns.
     *
     * @return array
     */
    protected function getSearchables()
    {
        return $this->searchables;
    }
}
