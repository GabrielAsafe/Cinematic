<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sala_id' => 'required|exists:salas,id',
            'data' => 'required',
            'horario_inicio' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'sala_id.exists' => 'A sala selecionada não está registada',
            'data.required' => 'Uma data deve ser selecionada',
            'horario_inicio.required' => 'Um horário deve ser selecionado',
        ];
    }
}
