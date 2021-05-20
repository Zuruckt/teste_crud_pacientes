<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostSymptomsRequest extends FormRequest
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
            'symptoms' => 'nullable|array',
            'symptoms.*' => 'sometimes|exists:symptoms,id'
        ];
    }

    public function messages()
    {
        return [
            'symptoms' => [
                'required' => 'o campo sintomas é necessário.',
                'array' => 'O campo sintomas deve ser um array.',
            ],
            'symptoms.*' => [
                'exists' => 'Sintoma não encontrado.',
            ]
        ];
    }
}
