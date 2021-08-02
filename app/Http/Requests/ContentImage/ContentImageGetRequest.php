<?php

namespace App\Http\Requests\ContentImage;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContentImageGetRequest extends FormRequest
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
            'contentId' => ['required', 'integer', 'exists:App\Models\Content,id']
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
            'integer'   => 'O campo :attribute deve ser um número inteiro',
            'exists'    => 'O conteúdo (ID :input) deve existir no banco de dados'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function failedValidation(Validator $validator)
    {
        if ($this->ajax()) {
            throw new HttpResponseException(response()->json([
                'message' => implode(', ', $validator->errors()->all())
            ], 422));
        }

        throw new HttpResponseException(response(
            implode(', ', $validator->errors()->all()),
            422
        ));
    }
}
