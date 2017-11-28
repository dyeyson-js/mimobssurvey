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

    public function update(Request $request, $id = null)
    {
        if($id) {
            $mimo = $this->mimoRepository->update($request, $id);
            return $mimo;
        }

        abort(404);
    }
}