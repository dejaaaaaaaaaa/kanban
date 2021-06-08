<?php

namespace App\Services;

use App\Enums\TicketAction;
use App\Events\TicketActionEvent;
use App\Models\Ticket;
use App\Repositories\Interfaces\PriorityRepositoryInterface;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;


class TicketService
{
    /**
    *
    * @var TicketRepositoryInterface $ticketRepository
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

    public function findById(int $id) :?Ticket
    {
        return $this->ticketRepository->findById($id);
    }

    public function store(array $data) :Ticket
    {
        $ticket = $this->ticketRepository->store($this->setDefaults($data));
        TicketActionEvent::dispatch($ticket, TicketAction::getValue('Created'));

        return $ticket;
    }

    public function update(int $id, array $data) :?Ticket
    {
        $ticket = $this->ticketRepository->update($id, $data);
        if($ticket){
            TicketActionEvent::dispatch($ticket, TicketAction::getValue('Updated'));
        }

        return $ticket;
    }

    public function delete(int $id) :void
    {
        $ticket = $this->ticketRepository->findById($id);
        $this->ticketRepository->delete($id);

        TicketActionEvent::dispatch($ticket, TicketAction::getValue('Deleted'));
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
