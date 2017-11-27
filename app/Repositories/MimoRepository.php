<?php

namespace App\Repositories;

use DB;
use App\Models\Mimo;
use Illuminate\Http\Request;

class MimoRepository 
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $mimo = new Mimo();
            $mimo->fill($this->sanitizeData($request->all()));
            $mimo->participant_id = $request->participant_id;
            $mimo->save();
        }
        catch(\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();
        return $mimo;
    }

    protected function sanitizeData(array $data)
    {
        $data['content'] = [
            'active_income_default' => $data['active_income_default'],
            'active_income_addon' => $data['active_income_addon'],
            'passive_income_default' => $data['passive_income_default'],
            'passive_income_addon' => $data['passive_income_addon'],
            'regular_expenses_default' => $data['regular_expenses_default'],
            'regular_expenses_addon' => $data['regular_expenses_addon'],
            'occassional_expenses_addon' => $data['occassional_expenses_addon']
        ];

        return $data;
    }
}