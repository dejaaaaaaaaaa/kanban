<?php

namespace App\Repositories\Interfaces;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;

interface TicketHistoryRepositoryInterface
{
    public function history(int $ticketId) :Collection;

}
