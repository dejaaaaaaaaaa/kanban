<?php

namespace App\Services;

use App\Repositories\Interfaces\TicketHistoryRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;


class TicketHistoryService
{
    /**
    *
    * @var TicketHistoryRepository $ticketHistoryRepository
    */
    private $ticketHistoryRepository;


    /**
     * TicketHistoryService constructor.
     */
    public function __construct(TicketHistoryRepositoryInterface $ticketHistoryRepository)
    {
        $this->ticketHistoryRepository = $ticketHistoryRepository;
    }

    public function history(int $ticketId) :Collection
    {
        return $this->ticketHistoryRepository->history($ticketId);
    }
}
