<?php

namespace App\Services;

use App\Repositories\Interfaces\SearchTicketRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;


class SearchTicketService
{
    /**
    *
    * @var SearchTicketRepository $searchTicketRepository
    */
    private $searchTicketRepository;

    /**
     * SearchTicketService constructor.
     */
    public function __construct(SearchTicketRepositoryInterface $searchTicketRepository)
    {
        $this->searchTicketRepository = $searchTicketRepository;
    }

    public function search(string $search) :Collection
    {
        return $this->searchTicketRepository->search($search);
    }
}
