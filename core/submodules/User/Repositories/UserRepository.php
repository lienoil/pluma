<?php

namespace User\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use Pluma\Repository\Repository;
use User\Models\User;

class UserRepository extends Repository
{
    /**
     * The model class name.
     *
     * @return  mixed
     */
    public function model()
    {
        return new User();
    }

    /**
     * Set of rules the model should be validated against when
     * storing or updating a resource.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'password' => 'sometimes|required|min:6|confirmed',
            'username' => [
                'required',
                Rule::unique('users')->ignore(self::$id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(self::$id),
            ],
            'roles' => 'array|required',
        ];
    }

    /**
     * Array of custom error messages upon validation.
     *
     * @return array
     */
    public static function messages()
    {
        return [
            'roles.required' => 'Atleast one role is required.',
        ];
    }

    /**
     * Save the resource to storage.
     *
     * @return \Pluma\Models\Model
     */
    public function create(array $data)
    {
        $this->model->prefixname = $data['prefixname'] ?? null;
        $this->model->firstname = $data['firstname'];
        $this->model->middlename = $data['middlename'] ?? null;
        $this->model->lastname = $data['lastname'];
        $this->model->username = $data['username'];
        $this->model->email = $data['email'];
        $this->model->password = bcrypt($data['password']);
        $this->model->avatar = $data['avatar'] ?? null;
        $this->model->tokenize($data['username']);
        $this->model->save();

        collect($data['roles'] ?? [])->each(function ($id) {
            $this->model->roles()->attach($id);
        });

        collect(($data['details'] ?? []))->each(function ($value, $key) {
            $this->model->details()->create(['key' => $key, 'value' => $value]);
        });

        return $this->model;
    }
}
