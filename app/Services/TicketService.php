<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\Interfaces\PriorityRepositoryInterface;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class TicketService
{
    /**
    *
    * @var TicketRepository $ticketRepository
    */
    private $ticketRepository;

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
    public function __construct(
        TicketRepositoryInterface $ticketRepository,
        StatusRepositoryInterface $statusRepository,
        PriorityRepositoryInterface $priorityRepository
    )
    {
        $this->ticketRepository = $ticketRepository;
        $this->statusRepository = $statusRepository;
        $this->priorityRepository = $priorityRepository;
    }

    public function index() :Collection
    {
        return $this->ticketRepository->getAll();
    }

    public function findById(int $id) :Ticket
    {
        return $this->ticketRepository->findById($id);
    }

    public function store(array $data) :Ticket
    {
        return $this->ticketRepository->store($this->setDefaults($data));
    }

    public function update(int $id, array $data) :Ticket
    {
        return $this->ticketRepository->update($id, $data);
    }

    public function delete(int $id) :void
    {
        $this->ticketRepository->delete($id);
    }

    protected function setDefaults(array $data) :array
    {
        if(!isset($data['status_id'])){
            $data['status_id'] = $this->statusRepository->first();
        }

        if(!isset($data['priority_id'])) {
            $data['priority_id'] = $this->priorityRepository->first();
        }
        $data['user_id'] = auth()->id();

        return $data;
    }

    public function ticketsPerStatus($statusId) :Collection
    {
        return $this->ticketRepository->ticketsPerStatus($statusId);
    }

    public function countPerStatus($statusId) :int
    {
        return $this->ticketRepository->countPerStatus($statusId);
    }
}
