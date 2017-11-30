<?php

namespace App\Services;

use App\Repositories\SurveyRepository;
use Illuminate\Http\Request;

class SurveyService
{
    public function __construct(SurveyRepository $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }
    
    public function store(Request $request)
    {
        $survey = $this->surveyRepository->store($request);
        return $survey;
    }

    public function generatePDF(Request $request)
    {
        $survey = $this->surveyRepository->generate($request);
        return $survey;
    }
}