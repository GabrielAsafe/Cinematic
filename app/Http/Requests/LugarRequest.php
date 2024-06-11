<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LugarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fila' => 'required',
            'posicao' => ['required', Rule::unique('lugares')->where(function ($query) {
                return $query->where([
                    ['sala_id', $this->input('sala_id')],
                    ['fila', $this->input('fila')],
                ]);
            })],
        ];
    }
    public function messages(): array
    {
        return [
            'fila.required' => 'Por favor, selecione uma fila.',
            'posicao.required' => 'Por favor, selecione uma posição.',
            'posicao.unique' => 'Está posiçao já existe',
        ];
    }
}
