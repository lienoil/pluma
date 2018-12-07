<?php

namespace Menu\Requests;

use Menu\Repositories\MenuRepository;
use Pluma\Requests\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return MenuRepository::rules();
    }

    /**
     * The array of override messages to use.
     *
     * @return array
     */
    public function messages()
    {
        return MenuRepository::messages();
    }
}
