<?php

namespace App\Http\Requests\Content;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContentGetRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->route()->uri() == "contents/form/{id?}") {
            $this->merge(['contentId' => $this->route('id')]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->route()->uri() == "contents/form/{id?}") {
            return [
                'contentId' => ['required', 'integer', 'exists:App\Models\Content,id']
            ];
        }

        return [
            'categoryId' => ['required', 'integer', 'exists:App\Models\ContentCategory,id']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        if ($this->route()->uri() == "contents/form/{id?}") {
            return [
                'required'  => 'O campo :attribute é obrigatório',
                'integer'   => 'O campo :attribute deve ser um número inteiro',
                'exists'    => 'O conteúdo (ID :input) deve existir no banco de dados'
            ];
        }

        return [
            'required'  => 'O campo :attribute é obrigatório',
            'integer'   => 'O campo :attribute deve ser um número inteiro',
            'exists'    => 'O categoria (ID :input) deve existir no banco de dados'
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
