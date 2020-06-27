<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestAnswer extends FormRequest
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
            'is_correct' => 'required',
            'answer.*' => 'distinct|required',
        ];

        return $rules;
    }

    //custom message
    public function messages()
    {
        $messages = [
            'is_correct.required' => 'Please choice correct is required',
        ];

        $answers = $this->request->get('answer');
        if (is_array($answers)) {
            foreach($answers as $key => $value)
            {
                $messages['answer.'.$key.'.distinct'] = 'The field "Answer '.$key.'" must have distinct!';
                $messages['answer.'.$key.'.required'] = 'The field "Answer '.$key.'" must have required!';
            }
        }

        return $messages;
    }
}
