<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'titulo' => 'required',
            'genero_code' => 'required|exists:generos,code',
            'ano' => 'required',
            'cartaz_url' => 'required',
            'sumario' => 'required',
            'trailer_url' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'titulo.required' => 'O titulo é obrigatório',
            'genero_code.required' => 'O genero é obrigatório',
            'genero_code.exists' => 'O genero não existe na base de dados',
            'ano.required' => 'O ano é obrigatório',
            'ano.integer' => 'O ano deve ser um nº inteiro',
            'cartaz_url.required' => 'O URL do cartaz é obrigatório',
            'trailer_url.required' => 'O URL do trailer é obrigatório',
        ];
    }
}