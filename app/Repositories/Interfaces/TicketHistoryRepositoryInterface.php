<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface TicketHistoryRepositoryInterface
{
    public function history(int $ticketId) :Collection;

}
