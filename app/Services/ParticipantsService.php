<?php
// app/Services/ParticipantsService.php

namespace App\Services;

class ParticipantsService
{
    public function getParticipantsDetails($participantIds, $participants)
    {
        $participantsDetails = [];

        foreach ($participantIds as $participantId) {
            $participant = $this->getParticipantById($participantId, $participants);
            if ($participant) {
                $participantsDetails[] = $participant;
            }
        }

        return $participantsDetails;
    }

    private function getParticipantById($participantId, $participants)
    {
        foreach ($participants as $participant) {
            if ($participant['id'] === $participantId) {
                return $participant;
            }
        }

        return null;
    }
}