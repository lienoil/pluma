<?php

namespace Pluma\Support\Repository;

class Repository implements RepositoryInterface
{
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
     * Retrieve all instances of model.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
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
        return $this->model->findOrFail($id);
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
}
