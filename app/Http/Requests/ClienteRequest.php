<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('users', 'name')->ignore($this->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->id),
            ],
            'admin' => 'sometimes|boolean',
            'nif' => 'sometimes',
            'tipo_pagamento' => 'sometimes',
            'ref_pagamento' => function ($attribute, $value, $fail) {
                $tipoPagamento = $this->input('tipo_pagamento');

                if ($tipoPagamento == 'VISA') {
                    if (!preg_match('/^\d{16}$/', $value)) {
                        $fail('O número do cartão de crédito deve ter 16 dígitos.');
                    }
                } elseif ($tipoPagamento == 'PAYPAL') {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $fail('O e-mail da conta do Paypal é inválido.');
                    }
                } elseif ($tipoPagamento == 'MBWAY') {
                    if (!preg_match('/^9\d{8}$/', $value)) {
                        $fail('O número de telemóvel para MBWAY deve ter 9 dígitos, começando com 9.');
                    }
                } elseif ($tipoPagamento === null) {
                    if ($value !== null) {
                        $fail('A referência de pagamento não deve ser preenchida se o tipo de pagamento for nulo.');
                    }
                }
            },
            'file_foto' => 'sometimes|image|max:4096', // maxsize = 4Mb,
            'bloqueado' => 'sometimes'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' =>  'O nome é obrigatório',
            'name.unique' =>    'O nome tem que ser único',
            'email.required' => 'O email é obrigatório',
            'email.email' =>    'O formato do email é inválido',
            'email.unique' =>   'O email tem que ser único',
            'bloqueado.boolean' =>  'O campo "bloqueado" tem que ser um booleano',
            'file_foto.image' => 'O ficheiro com a foto não é uma imagem',
            'file_foto.size' => 'O tamanho do ficheiro com a foto tem que ser inferior a 4 Mb'
        ];
    }
}
