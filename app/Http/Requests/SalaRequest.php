<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'nome' => 'required',
            'quantidade' => 'sometimes|numeric|min:0',
        ];
    }
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'quantidade.numeric' => 'A quantidade deve ser um número',
            'quantidade.min' => 'A quantidade não pode ser menor que 0',
        ];
    }
}
