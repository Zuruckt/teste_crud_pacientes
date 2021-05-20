<?php

namespace App\Repositories;

use App\Models\Symptom;

class SymptomRepository
{
    public function __construct(
        private Symptom $model
    ) {}

    public function getAllSymptoms()
    {
        return $this->model->all();
    }
}