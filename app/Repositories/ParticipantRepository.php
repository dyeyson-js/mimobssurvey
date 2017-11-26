<?php

namespace App\Repositories;

use DB;
use App\Models\Participant;
use Carbon\Carbon;

class ParticipantRepository
{
    public function store($request)
    {
        DB::beginTransaction();

        try {
            $participant = new Participant();
            $participant->fill($this->sanitizeData($request->all()));
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