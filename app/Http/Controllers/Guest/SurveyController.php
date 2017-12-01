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
    public function index()
    {
        return view('surveys.index');
    }

    public function showMimoBsForm()
    {
        $currencies = $this->currencyService->all();

        Javascript::put([
            'currencies' => $currencies
        ]);
     
        return view('surveys.mimopbs');
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
}
