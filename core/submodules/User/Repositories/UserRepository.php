<?php

namespace User\Repositories;

use Illuminate\Database\QueryException;
use User\Exceptions\CreateUserErrorException;
use User\Models\User;

class UserRepository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Create User resource.
     *
     * @param array $data
     * @return User
     * @throws CreateUserErrorException
     */
    public function create(array $data) : User
    {
        return $this->model->create($data);
        // try {
        // } catch (QueryException $e) {
        //     throw new QueryException($e);
        // }
    }
}
