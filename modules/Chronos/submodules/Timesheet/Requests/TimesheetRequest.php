<?php

namespace Timesheet\Requests;

use Pluma\Requests\FormRequest;

class TimesheetRequest extends FormRequest
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
                if ($this->user()->can('store-timesheet')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-timesheet')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-timesheet')) {
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
            'name' => 'required',
            'work' => 'required',
            'dates' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
            // 'name' => 'required|max:255',
            // 'code' => 'required|regex:/^[\pL\s\-\*\#\(0-9)]+$/u|unique:timesheets'.$isUpdating,
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
