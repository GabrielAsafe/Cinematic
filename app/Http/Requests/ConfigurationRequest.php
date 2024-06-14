<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationRequest extends FormRequest
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
            'preco_bilhete_sem_iva' => 'required|numeric|min:0',
            'percentagem_iva' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'preco_bilhete_sem_iva.required' => 'O preço do bilhete sem IVA é obrigatório',
            'preco_bilhete_sem_iva.numeric' => 'O preço do bilhete sem IVA deve ser um número',
            'preco_bilhete_sem_iva.min' => 'O preço do bilhete sem IVA não pode ser menor que 0',
            'percentagem_iva.required' => 'A percentagem de IVA é obrigatória',
            'percentagem_iva.numeric' => 'A percentagem de IVA deve ser um número',
            'percentagem_iva.min' => 'A percentagem de IVA não pode ser menor que 0',
        ];
    }

}
