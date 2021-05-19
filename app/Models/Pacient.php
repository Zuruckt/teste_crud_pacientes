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

    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class);
    }
}
