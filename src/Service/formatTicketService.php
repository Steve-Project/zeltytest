<?php

namespace App\Service;

use App\Trait\CorrespondenceTrait;

class formatTicketService
{
    use CorrespondenceTrait;
    public function formatTicket(string $ticketDeCaisse): string
    {
        $upperTicket = strtoupper($ticketDeCaisse);
        $search = $this->getSearchCorrespondence();
        $replace = $this->getChangeCorrespondence();
        //dd(preg_match_all('/[^A-Z0-9,]+/i', $changedTicket));

        return str_replace($search, $replace, $upperTicket);
    }
}