<?php

namespace Page\Requests;

use Illuminate\Http\Request;
use Page\Models\Page;
use Pluma\Requests\FormRequest;

class PageRequest extends FormRequest
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
                if ($this->user()->can('store-page')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-page')) {
                    return true;
                }
                break;

            case 'PATCH':
                if ($this->user()->can('restore-page')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-page')) {
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
            'title' => 'required|max:255',
            'code' => 'required|regex:/^[\pL\s\-\*\#\(0-9)]+$/u|unique:pages' . $isUpdating,
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
            'code.regex' => 'Only letters, numbers, spaces, and hypens are allowed.',
        ];
    }
}
