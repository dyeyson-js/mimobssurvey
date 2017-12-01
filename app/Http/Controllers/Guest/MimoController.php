<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MimoRequest;
use App\Services\MimoService;

class MimoController extends Controller
{
    private $mimoService;

    public function __construct(MimoService $mimoService)
    {
        $this->mimoService = $mimoService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MimoRequest $request)
    {
        $mimo = $this->mimoService->store($request);
        return response()->json([
            'status' => 'success',
            'module' => 'survey.mimo',
            'mimo' => $mimo 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mimo = $this->mimoService->update($request, $id);
        return response()->json([
            'status' => 'success',
            'module' => 'survey.mimo',
            'mimo' => $mimo 
        ]);
    }
}
