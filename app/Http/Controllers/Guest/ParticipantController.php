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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getParticipantCurrency(Request $request)
    {
        $participant = $this->participantService->getParticipantById($request->id);
        $currency = $this->currencyService->getCurrency($participant->currency);
        return $currency;
    }
}
