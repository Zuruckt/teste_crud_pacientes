<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Symptom extends Model
{
    protected $fillable = [
        'name'
    ];

    public function pacients(): BelongsToMany
    {
        return $this->belongsToMany(Pacient::class);
    }
}
