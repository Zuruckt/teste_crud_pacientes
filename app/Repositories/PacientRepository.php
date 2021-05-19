<?php

namespace App\Repositories;

use App\Models\Pacient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class PacientRepository
{
    public function __construct(
        private Pacient $model
    ) {}
    
    public function getAllPacients(): Collection
    {
        return $this->model->all();
    }

    public function postPacient($data): Pacient
    {
        $path = Storage::putFile('pacient_photos', $data['profile_photo']);

        $data['profile_photo'] = $path;

        return $this->model->create($data);
    }

    public function deletePacient($id): bool
    {
        $model = $this->model->find($id);

        Storage::delete($model->profile_photo);
        $model->symptoms()->sync([]);
        
        return $model->delete();
    }
}