<?php

namespace Library\Repositories;

use Library\Models\Library;
use Pluma\Support\Repository\Repository;

class LibraryRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Library::class;

    /**
     * Set of rules the model should be validated against when
     * storing or updating a resource
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'name' => 'required|max:255',
            'originalname' => 'required|max:255',
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
            'originalname.unique' => 'The file or the filename already exists.',
            'file.*.mimes' => 'The file type is not allowed to be uploaded.',
        ];
    }
}
