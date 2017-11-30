<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CurrencyService;
use App\Services\SurveyService;
use Javascript;

class SurveyController extends Controller
{
    private $currencyService;

    public function __construct(
        CurrencyService $currencyService,
        SurveyService $surveyService
    )
    {
        $this->currencyService = $currencyService;
        $this->surveyService = $surveyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($survey_type = "mimopbs")
    {
        $currencies = $this->currencyService->all();

        Javascript::put([
            'currencies' => $currencies
        ]);
     
        return view(sprintf('surveys.%s', $survey_type));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $survey = $this->surveyService->store($request);
        return response()->json([
            'status' => 'success',
            'module' => 'survey',
            'survey' => $survey,
            'downloadLink' => route('survey.download'),
            'refreshLink' => route('survey.index') 
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
        //
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
}
