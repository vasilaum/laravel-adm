<?php

namespace App\Http\Requests\ContentImage;

use Illuminate\Foundation\Http\FormRequest;

class ContentImagePutRequest extends FormRequest
{

    protected $stopOnFirstFailure = false;

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
            'title'         => ['max:50', 'min:3'],
            'order'         => ['required', 'integer']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required'      => 'O campo :attribute é obrigatório',
            'max'           => 'O campo :attribute deve ser menor ou igual a :max (Caracteres ou KB)',
            'min'           => 'O campo :attribute deve ser maior ou igual a :min',
            'integer'       => 'O campo :attribute deve ser um número inteiro'
        ];
    }
}