<?php

namespace Test\Repositories;

use Pluma\Support\Repository\Repository;
use Test\Models\Test;

class TestRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Test::class;

    /**
     * Set of rules the model should be validated against when
     * storing or updating a resource.
     *
     * @return array
     */
    public static function rules()
    {
        return [];
    }

    /**
     * Array of custom error messages upon validation.
     *
     * @return array
     */
    public static function messages()
    {
        return [];
    }

    /**
     * Retrieve the full model instance.
     *
     * @return \Pluma\Models\Model
     */
    public function model()
    {
        return $this->model;
    }
}
