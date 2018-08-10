<?php

namespace Content\Request;

use Pluma\Requests\FormRequest;

class ContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method()) {
            case 'POST':
                if ($this->user()->can('store-content')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-content')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-content')) {
                    return true;
                }
                break;

            default:
                return false;
                break;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        $isUpdating = $this->method() == "PUT" ? ",id,$this->id" : "";

        return [
            'name' => 'required|max:255',
            'code' => '
                required|regex:/^[\pL\s\-\*\#\(0-9)]+$/u|unique:contents'
                .$isUpdating,
        ];
    }

    /**
     * The array of override message to use.
     *
     * @return array
     */
    public function message()
    {
        return [
            'code.regex' => 'Only letters, numbers, spaces, and hypens are allowed.'
        ];
    }
}
