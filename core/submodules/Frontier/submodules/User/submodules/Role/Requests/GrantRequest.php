<?php

namespace Role\Requests;

use Pluma\Requests\FormRequest;

class GrantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

        switch ($this->method()) {
            case 'POST':
                if ($this->user()->can('store-grant')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-grant')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-grant')) {
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
            'name' => 'required|max:255',
            'code'    => 'required|unique:grants'.$isUpdating,
        ];
    }
}
