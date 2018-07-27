<?php

namespace Pluma\Support\Repository;

abstract class Repository implements RepositoryInterface
{
    const KEY_ONLY_TRASHED = 'only_trashed';
    const KEY_ORDERBY = 'order';
    const KEY_SEARCH = 'search';
    const KEY_SORT = 'sort';
    const KEY_TAKE = 'take';
    const KEY_OFFSET = 'offset';
    const KEY_PAGINATE = 'paginate';

    /**
     * The property on class instances.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The static id of the resource.
     *
     * @var int
     */
    protected static $id;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct($model = null)
    {
        $this->model = $model ?? new $this->model;
    }

    /**
     * Bind the resource model statically.
     *
     * @param mixed $model
     * @return self
     */
    public static function bind($id)
    {
        $instance = new static;
        $model = new $instance->model;
        $resource = $model->find($id);

        self::$id = $id;

        $instance->model = $resource ?? $model;

        return $instance;
    }

    /**
     * The model instance.
     *
     * @return \Pluma\Models\Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Search the model.
     *
     * @param array $parameters
     * @return self
     */
    public function search($parameters)
    {
        $this->parameters = $this->params($parameters);
        $this->model = $this->model->search($this->parameters[self::KEY_SEARCH]);

        return $this;
    }

    /**
     * Returns a paginated instance of the model.
     *
     * @return self
     */
    public function paginate()
    {
        return $this->model->paginate();
    }

    /**
     * Retrieve all instances of model.
     *
     * @return mixed
     */
    public function all()
    {
        $this->model = $this->model->all();

        return $this;
    }

    /**
     * Create model resource.
     *
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update model resource.
     *
     * @param array  $data
     * @param int $id
     */
    public function update(array $data, $id)
    {
        return $this->model->update($data, $id);
    }

    /**
     * Retrieve model resource details.
     *
     * @param int $id
     */
    public function find($id)
    {
        $this->model = $this->model->findOrFail($id);

        return $this;
    }

    /**
     * Permanently delete model resource.
     *
     * @param int $id
     */
    public function delete($id)
    {
        return $this->model->forceDelete($id);
    }

    /**
     * Soft delete model resource.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        return $this->model->delete($id);
    }

    /**
     * Restore model resource.
     *
     * @param int $id
     */
    public function restore($id)
    {
        return $this->model->restore($id);
    }

    /**
     * Retrieve parameters for the model search.
     *
     * @param array $parameters
     * @return array
     */
    protected function params($parameters)
    {
        $onlyTrashed = $parameters[self::KEY_ONLY_TRASHED] ?? false;
        $search = $parameters[self::KEY_SEARCH] ?? $parameters;
        $orderBy = $parameters[self::KEY_ORDERBY] ?? false;
        $sort = $parameters[self::KEY_SORT] ?? 'ASC';
        $take = $parameters[self::KEY_TAKE] ?? false;
        $offset = $parameters[self::KEY_OFFSET] ?? 0;
        $paginate = $parameters[self::KEY_OFFSET] ?? false;

        if ($onlyTrashed) {
            $this->model = $this->model->onlyTrashed();
        }

        if ($orderBy) {
            $this->model = $this->model->orderBy($orderBy, $sort);
        }

        if ($take) {
            // $this->model = $this->model->offset($offset)->limit($take)->get();
        }

        if ($paginate) {
            // $this->model = $this->model->paginate($paginate);
        }

        return [
            self::KEY_ORDERBY => $orderBy,
            self::KEY_ONLY_TRASHED => $onlyTrashed,
            self::KEY_SEARCH => $search,
            self::KEY_SORT => $sort,
            self::KEY_TAKE => $take,
            self::KEY_OFFSET => $offset,
            self::KEY_PAGINATE => $paginate,
        ];
    }
}
