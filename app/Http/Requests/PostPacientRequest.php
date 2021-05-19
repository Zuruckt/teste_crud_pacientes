<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostPacientRequest extends FormRequest
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
            'name' => 'required|string',
            'birth_date' => 'required|date',
            'cpf' => 'required|cpf',
            'telephone_number' => 'required|celular_com_ddd',
            'profile_photo' => 'required|image',
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
                'dimensions' => 'O campo foto deve ter no máximo 354 pixels de comprimento e 472 pixels de altura (Foto 3x4).',
            ]
        ];
    }
}
