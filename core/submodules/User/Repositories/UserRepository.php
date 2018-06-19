<?php

namespace User\Repositories;

use Illuminate\Database\QueryException;
use Pluma\Support\Repository\Repository;
use User\Models\User;

class UserRepository extends Repository
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
}
