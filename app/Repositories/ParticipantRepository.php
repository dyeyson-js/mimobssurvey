<?php

namespace App\Repositories;

use DB;
use Carbon\Carbon;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantRepository
{
    public function getById($id)
    {
        $participant = Participant::findOrFail($id);
        return $participant;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $participant = new Participant();
            $participant->fill($this->sanitizeData($request->all()));
            $participant->save();
        }
        catch(\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();
        return $participant;
    }

    protected function sanitizeData(array $data)
    {
        $data['birth_date'] = Carbon::createFromFormat('m/d/Y', $data['birth_date']);
        return $data;
    }
}