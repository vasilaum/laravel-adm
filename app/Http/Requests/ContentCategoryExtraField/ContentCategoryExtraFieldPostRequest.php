<?php

namespace App\Http\Requests\ContentCategoryExtraField;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ContentCategoryExtraFieldPostRequest extends FormRequest
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
            'name'          => ['required', 'min:3', 'max:100'],
            'category_id'   => ['required', 'integer', 'exists:App\Models\ContentCategory,id'],
            'type'          => [
                'required',
                Rule::in([
                    'number', 'text', 'textarea', 'date', 'select', 'radio',
                    'checkbox', 'email'
                ])
            ],
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
            'exists'    => 'O módulo (ID :input) deve existir no banco de dados'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function failedValidation(Validator $validator)
    {
        if($this->ajax()) {
            throw new HttpResponseException(response()->json([
                'message' => implode(', ', $validator->errors()->all())
            ], 422));
        }

        throw new HttpResponseException(response(
            implode(', ', $validator->errors()->all()
        ), 422));
    }
}
