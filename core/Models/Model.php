<?php

namespace Pluma\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Pluma\Support\Mutators\BaseMutator;

class Model extends BaseModel
{
    use BaseMutator;

    /**
     * Accessors to append on every request.
     *
     * @var array
     */
    protected $appends = ['created', 'excerpt'];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 5;

    /**
     * Array of searchable columns.
     *
     * @var array
     */
    protected $searchables = [];

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setPerPage(config('settings.global.per_page', $this->perPage));
    }

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
