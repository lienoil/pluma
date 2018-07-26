<?php

namespace Course\Requests;

use Course\Models\Course;
use Course\Repositories\CourseRepository;
use Pluma\Requests\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO:
        // added check if user is Root to skip authorization
        // ENDTODO
        if ($this->user()->isRoot()) {
            return true;
        }

        switch ($this->method()) {
            case 'POST':
                if ($this->user()->can('store-course')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-course')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-course')) {
                    return true;
                }
                break;

            default:
                return $this->user()->isRoot();
                break;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // TODO:
        // Updated your code.
        // your $this->course will return null,
        // we only use "$this->course " if the route has a {course}
        // E.g. routes/admin.php => Route::get('/courses/{course}', '...');
        //
        // Most of the time, the code below will work on all modules
        // ENDTODO
        return CourseRepository::rules();
    }

    /**
     * The array of override messages to use.
     *
     * @return array
     */
    public function messages()
    {
        // TODO:
        // Replaced messages to use the messages defined in CourseRepository
        // ENDTODO
        return CourseRepository::messages();
    }
}
