<?php

namespace Library\Requests;

use Pluma\Requests\FormRequest;

class LibraryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method()) {
            case 'POST':
                if ($this->user()->can('store-library')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-library')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-library')) {
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $isUpdating = $this->method() == "PUT" ? ",id,$this->id" : "";

        return [
            'name' => 'required|unique:library'.$isUpdating,
            // 'code' => 'required|regex:/^[\pL\s\-\*\#\(0-9)]+$/u|unique:libraries'.$isUpdating,
        ];
    }

    /**
     * The array of override messages to use.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => 'The file or the filename already exists.',
        ];
    }
}
