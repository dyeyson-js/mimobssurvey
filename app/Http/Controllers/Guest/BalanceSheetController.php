<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BalanceSheetRequest;
use App\Services\BalanceSheetService;

class BalanceSheetController extends Controller
{
    private $balanceSheetService;

    public function __construct(BalanceSheetService $balanceSheetService)
    {
        $this->balanceSheetService = $balanceSheetService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BalanceSheetRequest $request)
    {
        $bs = $this->balanceSheetService->store($request);
        return response()->json([
            'status' => 'success',
            'module' => 'survey.pbs',
            'bs' => $bs 
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
        $bs = $this->balanceSheetService->update($request, $id);
        return response()->json([
            'status' => 'success',
            'module' => 'survey.pbs',
            'bs' => $bs 
        ]);
    }
}
