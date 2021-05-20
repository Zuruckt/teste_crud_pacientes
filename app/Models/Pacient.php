<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pacient extends Model
{
    protected $fillable = [
        'name',
        'birth_date',
        'cpf',
        'telephone_number',
        'profile_photo',
    ];

    protected $appends = [
        'infection_status',
    ];

    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class);
    }

    public function getInfectionStatusAttribute()
    {
        $percent = round((($this->symptoms->count()) / 14) * 100);
        return match(true) {
            $percent <= 10 => 'SINTOMAS INSUFICIENTES',
            $percent >= 60 => 'POSSIVEL INFECTADO',
            $percent < 60, $percent >= 40 => 'POTENCIAL INFECTADO',
            default => 'DIFICILMENTE INFECTADO', //Não foi especificado no teste o retorno entre 40 e 10 por cento.
        };
    }
}
