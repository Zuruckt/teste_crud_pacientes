<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pacient extends Model
{
    protected $fillable = [
        'name',
        'birth_date',
        'cpf',
        'telephone_number',
        'profile_photo',
    ];

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class);
    }
}
