<?php

namespace Forum\Requests;

use Pluma\Requests\FormRequest;

class ForumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ( $this->method() ) {
            case 'POST':
                if ( $this->user()->can('store-forum') ) return true;
                break;

            case 'PUT':
                if ( $this->user()->can('update-forum') ) return true;
                break;

            case 'DELETE':
                if ( $this->user()->can('destroy-forum') ) return true;
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
        return [
            'title' => 'required',
            'body' => 'required',
            'slug' => 'required|unique:forums',
        ];
    }
}
