<?php

namespace App\Http\Requests\ContentImage;

use Illuminate\Foundation\Http\FormRequest;

class ContentImagePostRequest extends FormRequest
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
            'content_id'    => ['required', 'integer', 'exists:App\Models\Content,id'],
            'files'         => ['required'],
            'files.*'       => ['max:5000', 'mimes:png,jpg', 'dimensions:max_width=3000,max_height=3000']
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
            'integer'       => 'O campo :attribute deve ser um número inteiro',
            'exists'        => 'O conteúdo (ID :input) deve existir no banco de dados',
            'mimes'         => 'O tipo de arquivo não é permitido',
            'dimensions'    => 'As dimensões da imagem excedem o tamanho máximo (300px de altura e 3000px de largura)'
        ];
    }
}