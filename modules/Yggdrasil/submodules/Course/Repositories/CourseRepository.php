<?php

namespace Course\Repositories;

use Course\Models\Course;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use Pluma\Support\Repository\Repository;

class CourseRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var  \Illuminate\Database\Eloquent\Model
     */
    protected $model = Course::class;

    /**
     * Set of rule the model should be validated against when
     * storing or updating a resource.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'title' => 'required|max:255',
            'slug' => [
                'required',
                Rule::unique('courses')->ignore(self::$id),
            ],
            'code' => [
                'required',
                Rule::unique('courses')->ignore(self::$id),
            ],
            'feature' => 'required|max:255',
            'backdrop' => 'required|max:255',
            'body' => 'required|max:255',
        ];
    }
}
