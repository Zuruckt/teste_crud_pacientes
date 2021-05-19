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

    public function getPacient($id): Pacient
    {
        return $this->model->findOrFail($id);
    }

    public function postPacient(array $data): Pacient
    {
        $data['profile_photo'] = Storage::putFile('pacient_photos', $data['profile_photo']);

        return $this->model->create($data);
    }

    public function putPacient(int $id, array $data): Pacient | bool
    {
        $model = $this->model->findOrFail($id);

        Storage::delete($model->profile_photo);
        $data['profile_photo'] = Storage::putFile('pacient_photos', $data['profile_photo']);
    
        if(!$model->update($data)) return false;
        return $model->refresh();
    }

    public function deletePacient(int $id): bool
    {
        $model = $this->model->findOrFail($id);

        Storage::delete($model->profile_photo);
        $model->symptoms()->sync([]);
        
        return $model->delete();
    }
}