<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'     => 'required|string',
            'content'   => 'required|string',
            'abstract'  => 'required|string',
            'published' => 'required',
            'thumbnail' => 'image|max:'.env('MAX_UPLOAD', 2000).'|nullable'
        ];
    }

    public function messages ()
    {
        return [
            'required' => 'Ce champ est obligatoire',
            'image'    => 'Le fichier n\'est pas une image valide',
            'max'      => 'L\'image est trop grande (max: 2mo)'
        ];
    }
}
