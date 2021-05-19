<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostPacientRequest;
use App\Http\Requests\PutPacientRequest;
use App\Repositories\PacientRepository;
use Illuminate\Http\Request;

class PacientController extends Controller
{

    public function __construct(
        private PacientRepository $repository
    ) {}

    public function postPacient(PostPacientRequest $request)
    {
        $data = $request->validated();
        return response()->json($this->repository->postPacient($data), 201);
    }

    public function getAllPacients()
    {
        return response()->json($this->repository->getAllPacients());
    }

    public function getPacient($id)
    {
       return $this->repository->getPacient($id);
    }
    
    public function putPacient(PutPacientRequest $request, int $id)
    {
        $data = $this->repository->putPacient($id, $request->validated());

        if($data) return response()->json($data, 201);

        return response()->json(['error' => 'Failed to update.'], 500);
    }

    public function deletePacient(int $id)
    {
        if ($this->repository->deletePacient($id)) return response()->json(['message' => 'Deleted.'], 200);

        return response()->json(['error' => 'Failed to delete.'], 500);
    }
}
