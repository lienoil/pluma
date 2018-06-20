<?php

namespace Pluma\Requests;

use Pluma\Support\Request\FormRequest as BaseRequest;

class FormRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function forbiddenResponse()
    {
        return response()->view('Theme::errors.403', [
            'error' => [
                'code' => 'NOT_AUTHORIZED',
                'message' => 'Unauthorized.',
                'description' => '',
            ]
        ]);
    }
}
