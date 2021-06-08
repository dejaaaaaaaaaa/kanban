<?php

namespace App\Repositories;

use App\Models\TicketHistory;
use App\Repositories\Interfaces\TicketHistoryRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;

class TicketHistoryRepository  implements TicketHistoryRepositoryInterface
{

    /**
    * @var TicketHistory $model
    */
    private $model;

    /**
     * TicketRepository constructor.
     * @param TicketHistory $model
     */
    public function __construct(TicketHistory $model)
    {
        $this->model = $model;
    }

    public function history(int $ticketId): Collection
    {
        return $this->model
            ->where('ticket_id', $ticketId)
            ->with(['user', 'ticket'])
            ->latest()
            ->get();
    }

}
