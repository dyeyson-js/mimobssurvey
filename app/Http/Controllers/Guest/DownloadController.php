<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SurveyService;
use PDF;

class DownloadController extends Controller
{
    private $surveyService;

    public function __construct(SurveyService $surveyService)
    {
        $this->surveyService = $surveyService;
    }

    public function generatePDF(Request $request)
    {
        $view_name = sprintf('pdfs.%s', $request->survey_type);

        $data = $this->surveyService->generatePDF($request);

        $pdf = PDF::loadView($view_name, compact('data'));
        return $pdf->stream('soapnotes')->header('Content-Type','application/pdf');
    }
}
