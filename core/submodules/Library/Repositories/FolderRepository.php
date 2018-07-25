<?php

namespace Folder\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use Pluma\Support\Repository\Repository;
use Library\Models\Folder;

class FolderRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Folder::class;

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
}
