<?php

namespace App\Services;

use App\Repositories\ParticipantRepository;
use Illuminate\Http\Request;

class ParticipantService
{
    private $participantRepository;

    public function __construct(ParticipantRepository $participantRepository)
    {
        $this->participantRepository = $participantRepository;
    }

    public function getParticipantById($id = null)
    {
        if($id) {
            $participant = $this->participantRepository->getById($id);
            return $participant;
        }

        abort(404);
    }

    public function store(Request $request)
    {
        $participant = $this->participantRepository->store($request);
        return $participant;
    }
}