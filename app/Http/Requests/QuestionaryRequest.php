<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionaryRequest extends FormRequest
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
        return [
            'title'       => 'required|string',  
            'content'     => 'required|string',
            'published'   => 'required',
            'class_level' => 'required|in:first_class,final_class',
            'questions.*' => 'required'
        ];
    }

    public function messages ()
    {
        return [
            'required' => 'Ce champ est obligatoire'
        ];
    }
}
