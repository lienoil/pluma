<?php

namespace Pluma\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Pluma\Support\Database\Scopes\Exceptable;
use Pluma\Support\Database\Scopes\Searchable;
use Pluma\Support\Mutators\BaseMutator;
use Support\Database\Traits\BaseRelation;
use Support\Database\Traits\Relationships;

class Model extends BaseModel
{
    use BaseMutator, BaseRelation, Searchable, Exceptable;

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
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // For observer events
        Model::setEventDispatcher(app('events'));
    }
}
