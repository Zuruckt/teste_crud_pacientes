<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $fillable = [
        'name'
    ];

    public function pacients()
    {
        return $this->belongsToMany(Pacient::class);
    }
}
