<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\Interfaces\PriorityRepositoryInterface;
use App\Repositories\Interfaces\SearchTicketRepositoryInterface;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class SearchTicketService
{
    /**
    *
    * @var SearchTicketRepository $searchTicketRepository
    */
    private $searchTicketRepository;

    /**
     * @var StatusRepositoryInterface
     */
    private $statusRepository;

    /**
     * @var PriorityRepositoryInterface
     */
    private $priorityRepository;

    /**
     * TicketService constructor.
     */
    public function __construct(SearchTicketRepositoryInterface $searchTicketRepository)
    {
        $this->searchTicketRepository = $searchTicketRepository;
    }

    public function search($phrase) :Collection
    {
        return $this->searchTicketRepository->search($phrase);
    }
}
