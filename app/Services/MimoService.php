<?php

namespace App\Services;
use App\Repositories\MimoRepository;
use Illuminate\Http\Request;

class MimoService
{
    private $mimoRepository;

    public function __construct(MimoRepository $mimoRepository)
    {
        $this->mimoRepository = $mimoRepository;
    }

    public function store(Request $request)
    {
        $mimo = $this->mimoRepository->store($request);
        return $mimo;
    }
}