<?php

namespace App\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class ContentPutRequest extends FormRequest
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
            'name'          => ['required', 'max:100', 'min:3'],
            'data'          => ['required', 'min:5'],
            'date'          => ['required', 'date'],
            'category_id'   => ['required', 'integer'],
            'id'            => ['required', 'integer', 'exists:App\Models\Content,id']
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
            'required'  => 'O campo :attribute é obrigatório',
            'max'       => 'O campo :attribute deve ser menor ou igual a :max',
            'min'       => 'O campo :attribute deve ser maior ou igual a :min',
            'integer'   => 'O campo :attribute deve ser um número inteiro',
            'exists'    => 'O Registro (ID :input) deve existir no banco de dados',
            'date'      => 'O campo :attribute deve ser uma data válida'
        ];
    }
}