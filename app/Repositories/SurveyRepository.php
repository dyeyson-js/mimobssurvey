<?php

namespace App\Repositories;

use DB;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyRepository 
{

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
           $survey = new Survey();
           $survey->participant_id = $request->participant_id;
           $survey->survey_type = $request->survey_type;
           $survey->save();
        }
        catch(\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();
        return $survey;
    }

    public function generate(Request $request) {
        $survey = Survey::findOrFail($request->survey_id);
        
        return [
            'full_name' => $survey->participant->full_name,
            'birth_date' => $survey->participant->birth_date_formatted,
            'email' => $survey->participant->email,
            'phone_num' => $survey->participant->phone_num,
            'city' => $survey->participant->city,
            'currency' => $survey->participant->currency,

            'actual_emergency_savings' => $survey->participant->pbs->actual_emergency_savings,
            'total_expenses' => $survey->participant->mimo->total_expenses,
            'emergency_savings_adequancy' => $survey->participant->pbs->emergency_savings_adequancy,
            'house_and_lot' => $survey->participant->pbs->house_lot_value,
            'ideal_house_and_lot_budget' => $survey->participant->pbs->ideal_house_lot_budget,
            'house_and_lot_budget' => $survey->participant->pbs->actual_house_lot_budget,
            'age' => $survey->participant->age,
            'net_worth_multiplier' => $survey->participant->pbs->net_worth_multiplier,
            'monthly_income' => $survey->participant->mimo->total_income,
            'ideal_net_worth' => $survey->participant->pbs->ideal_net_worth,
            'actual_net_worth' => $survey->participant->pbs->net_worth,
            'actual_net_worth_age' => $survey->participant->pbs->net_worth_multiplier_age,
            'net_worth_age_difference' => $survey->participant->pbs->net_worth_age_difference,
            'passive_income' => $survey->participant->mimo->total_passive_income,
            'life_stage_percentage' => $survey->participant->mimo->life_stage_percentage,
            'life_stage' => $survey->participant->mimo->life_stage,
            'actual_life_stage_age' => $survey->participant->mimo->actual_life_stage_age,
            'life_stage_age_difference' => $survey->participant->mimo->life_stage_age_difference
        ];
    }
}