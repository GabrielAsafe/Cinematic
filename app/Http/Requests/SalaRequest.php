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
        ];
    }
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório',
        ];
    }
}
