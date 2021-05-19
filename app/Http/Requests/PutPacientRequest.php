<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PutPacientRequest extends FormRequest
{
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
            'name' => 'sometimes|required|string',
            'birth_date' => 'sometimes|required|date',
            'cpf' => 'sometimes|required|cpf',
            'telephone_number' => 'sometimes|required|celular_com_ddd',
            'profile_photo' => 'sometimes|required|image',
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'O campo nome é obrigatório.',
                'string' => 'O campo nome deve ser um texto.',
            ],
            'birth_date' => [
                'required' => 'O campo data é obrigatório.',
                'date' => 'O campo data deve ser uma data válida.',
            ],
            'cpf' => [
                'required' => 'O campo cpf é obrigatório.',
                'cpf' => 'O campo cpf deve ser um CPF válido.',
            ],
            'telephone_number' => [
                'required' => 'O campo telefone é obrigatório.',
                'celular_com_dd' => 'O campo telefone deve ter um formato válido.'
            ],
            'profile_photo' => [
                'required' => 'O campo foto é obrigatório.',
                'image' => 'O campo foto deve ser uma imagem.',
            ]
        ];
    }
}
