<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParticipantRequest;
use App\Services\ParticipantService;
use App\Services\CurrencyService;

class ParticipantController extends Controller
{
    private $participantService;
    private $currencyService;

    public function __construct(
        ParticipantService $participantService,
        CurrencyService $currencyService
    )
    {
        $this->participantService = $participantService;
        $this->currencyService = $currencyService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParticipantRequest $request)
    {
        $participant = $this->participantService->store($request);

        return response()->json([
            'status' => 'success',
            'module' => 'survey.participants',
            'participant' => $participant 
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
        $participant = $this->participantService->update($request, $id);

        return response()->json([
            'status' => 'success',
            'module' => 'survey.participants',
            'participant' => $participant 
        ]);
    }

    public function getParticipantCurrency(Request $request)
    {
        $participant = $this->participantService->getParticipantById($request->id);
        $currency = $this->currencyService->getCurrency($participant->currency);
        return $currency;
    }
}
