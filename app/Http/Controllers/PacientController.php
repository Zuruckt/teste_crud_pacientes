<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostPacientRequest;
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

    public function deletePacient(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        
        $this->validate($request, 
        ['id' => 'required|exists:pacients'],
        ['id' => [
            'required' => 'O campo id é necessário.',
            'exists' => 'Paciente não encontrado',
        ]]);

        if ($this->repository->deletePacient($id)) return response()->json(['message' => 'Deleted'], 200);

        return response()->json(['error' => 'Failed to delete'], 500);
    }
}
