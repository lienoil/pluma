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
        if ($this->user()->isRoot() || $this->user()->id === $this->id) {
            return true;
        }

        switch ($this->method()) {
            case 'POST':
                return $this->user()->can('store-user');
                break;

            case 'PUT':
                return $this->user()->can('update-user');
                break;

            case 'DELETE':
                return $this->user()->can('destroy-user');
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

        return User::$rules;
    }

    /**
     * The array of override messages to use.
     *
     * @return array
     */
    public function messages()
    {
        return User::$messages;
    }
}
