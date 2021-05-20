<?php

namespace Database\Seeders;

use App\Models\Symptom;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $symptoms = [
            'Febre',
            'Coriza',
            'Nariz Entupido',
            'Cansaço',
            'Tosse',
            'Dor de cabeça',
            'Dores no corpo',
            'Mal estar geral',
            'Dor de garganta',
            'Dificuldade de respirar',
            'Falta de paladar',
            'Falta de olfato',
            'Dificuldade de locomoção',
            'Diarréia',
        ];

        foreach($symptoms as $symptom) {
            Symptom::create(['name' => $symptom]);
        }
    }
}
