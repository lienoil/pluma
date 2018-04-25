<?php

namespace User\Requests;

use Pluma\Requests\FormRequest;
use User\Models\User;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->id === $this->id) {
            return true;
        }

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

        return User::rules($isUpdating);
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
