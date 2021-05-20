<?php

namespace App\Http\Controllers;

use App\Repositories\SymptomRepository;

class SymptomController extends Controller
{
    public function __construct(
        private SymptomRepository $repository
    ) {}

    public function getAllSymptoms()
    {
        return $this->repository->getAllSymptoms();
    }
}
