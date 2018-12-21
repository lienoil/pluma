<?php

namespace User\Requests;

use Pluma\Requests\FormRequest;
use User\Models\User;
use User\Repositories\UserRepository;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return UserRepository::bind($this->user)->rules();
    }

    /**
     * The array of override messages to use.
     *
     * @return array
     */
    public function messages()
    {
        return UserRepository::messages();
    }
}
