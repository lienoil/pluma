<?php

namespace User\Requests;

use Pluma\Requests\FormRequest;

class UserRequest extends FormRequest
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
                if ($this->user()->can('store-user')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-user')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-user')) {
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
            'firstname' => 'sometimes|required|max:255',
            'lastname' => 'sometimes|required|max:255',
            'password' => 'sometimes|required|min:6|confirmed',
            'username' => 'sometimes|required|regex:/^[\pL\s\-\.\*\#\(0-9)]+$/u|unique:users'.$isUpdating,
            'email' => 'required|email|unique:users'.$isUpdating,
            'roles' => 'sometimes|required',
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
            'description.regex' => 'Only letters, spaces, and hypens are allowed.',
        ];
    }
}
