<?php

namespace App\Http\Requests\SystemPermission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SystemPermissionPutRequest extends FormRequest
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
            'name'              => ['required', 'max:50', 'min:3'],
            'url_action'        => ['required', 'min:5'],
            'http_method'       => [
                'required',
                Rule::in([
                    'GET', 'POST', 'PUT', 'DELETE', 'OPTIONS',
                    'PATCH', 'HEAD', 'CONNECT', 'TRACE'
                ])
            ],
            'system_module_id'  => [
                'required',
                'integer',
                'exists:App\Models\SystemModule,id'
            ],
            'id' => ['required', 'integer', 'exists:App\Models\SystemPermission,id']
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
            'integer'   => 'O campo :attribute deve ser número inteiro',
            'in'        => 'O campo :attribute deve ser um destes valores :values',
            'exists'    => 'O Registro (Campo :attribute | ID :input) deve existir no banco de dados'
        ];
    }
}
