<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestQuestion extends FormRequest
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
        $rules = [
            'topic_id'      => 'required',
            'content'      => 'required',
            'level'   => 'required'
        ];

        return $rules;
    }

    //custom error message
    public function messages()
    {
        $messages = [
            'topic_id.required' => 'This field is required',
            'content.required' => 'This field is required',
            'level.required' => 'This field is required'
        ];

        return $messages;
    }
}
