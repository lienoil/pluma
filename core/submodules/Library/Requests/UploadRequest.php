<?php

namespace Library\Requests;

use Pluma\Requests\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $isUpdating = $this->method() == "PUT" ? ",id,$this->id" : "";
        $mimes = implode(',', config('download.supported', []));

        return [
            'originalname' => 'sometimes|required|unique:library'.$isUpdating,
            'file.*' => 'required|mimes:'.$mimes
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
            'originalname.unique' => 'The file or the filename already exists.',
            'file.*.mimes' => 'The file is not allowed to be uploaded.',
        ];
    }
}
