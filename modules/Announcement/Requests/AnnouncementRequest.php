<?php

namespace Announcement\Requests;

use Pluma\Requests\FormRequest;

class AnnouncementRequest extends FormRequest
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
                if ($this->user()->can('store-announcement')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-announcement')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-announcement')) {
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
            'code' => 'required|regex:/^[\pL\s\-\*\#\(0-9)]+$/u|unique:announcements'.$isUpdating,
            'published_at' => 'required',
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
            'published_at' => 'The publication date is required.'
        ];
    }
}
