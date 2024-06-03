<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;

class FilmeRequest extends FormRequest
{
    const MAX_YEAR = 10;

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $currentYear = Date::now()->year;
        $maxYear = $currentYear + self::MAX_YEAR;

        return [
            'titulo' => 'required',
            'genero_code' => 'required|exists:generos,code',
            'ano' => 'required|integer|between:1915,'. $maxYear,
            'file_cartaz' => 'sometimes|image|max:4096',
            'sumario' => 'required',
            'trailer_url' => 'required|url',
        ];
    }
    public function messages(): array
    {

        $currentYear = Date::now()->year;
        $maxYear = $currentYear + self::MAX_YEAR;

        return [
            'titulo.required' => 'O titulo é obrigatório',
            'genero_code.required' => 'O genero é obrigatório',
            'genero_code.exists' => 'O genero não existe na base de dados',
            'ano.required' => 'O ano é obrigatório',
            'ano.integer' => 'O ano deve ser um nº inteiro',
            'ano.between' => 'O ano deve ser entre 1915 e ' . $maxYear,
            'file_cartaz.image' => 'O ficheiro com a foto não é uma imagem',
            'file_cartaz.size' => 'O tamanho do ficheiro com a foto tem que ser inferior a 4 Mb',
            'trailer_url.required' => 'O URL do trailer é obrigatório',
            'trailer_url.url' => 'O URL do trailer é inválido',
        ];
    }
}
