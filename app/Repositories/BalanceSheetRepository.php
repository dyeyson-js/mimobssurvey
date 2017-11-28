<?php

namespace App\Repositories;

use DB;
use App\Models\BalanceSheet;
use Illuminate\Http\Request;

class BalanceSheetRepository
{
    public function store(Request $request)
    {  
        DB::beginTransaction();

        try {
            $bs = new BalanceSheet();
            $bs->fill($this->sanitizeData($request->all()));
            $bs->participant_id = $request->participant_id;
            $bs->save();
        }
        catch(\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();
        return $bs;
    }

    public function update(Request $request, $id)
    {  
        DB::beginTransaction();

        try {
            $bs = BalanceSheet::findOrFail($id);
            $bs->fill($this->sanitizeData($request->all()));
            $bs->participant_id = $request->participant_id;

            if($bs->isDirty()) {
                $bs->save();
            }
        }
        catch(\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();
        return $bs;
    }

    protected function sanitizeData(array $data)
    {
        $data['content'] = [
            'current_assets_default' => $data['current_assets_default'],
            'current_assets_addon' => $data['current_assets_addon'],
            'longterm_assets_default' => $data['longterm_assets_default'],
            'longterm_assets_addon' => $data['longterm_assets_addon'],
            'current_liabilities_default' => $data['current_liabilities_default'],
            'current_liabilities_addon' => $data['current_liabilities_addon'],
            'longterm_liabilities_default' => $data['longterm_liabilities_default'],
            'longterm_liabilities_addon' => $data['longterm_liabilities_addon'],
        ];

        return $data;
    }
}