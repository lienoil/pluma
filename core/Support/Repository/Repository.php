<?php

namespace Pluma\Support\Repository;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /**
     * The property on class instances.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
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
