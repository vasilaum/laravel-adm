<?php

namespace App\Http\Requests\SystemModule;

use Illuminate\Foundation\Http\FormRequest;

class SystemModulePutRequest extends FormRequest
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
            'name'      => ['required', 'max:50', 'min:3'],
            'codename'  => ['required', 'max:50', 'min:3'],
            'id'        => ['required', 'integer', 'exists:App\Models\SystemModule,id']
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
            'exists'    => 'O Registro (ID :input) deve existir no banco de dados'
        ];
    }
}
