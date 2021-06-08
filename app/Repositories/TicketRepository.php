<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Repositories\Interfaces\TicketRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TicketRepository  implements TicketRepositoryInterface
{

    /**
    * @var Ticket $model
    */
    private $model;

    /**
     * TicketRepository constructor.
     * @param Ticket $model
     */
    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model
            ->with(['user', 'status', 'priority', 'createdBy', 'updatedBy'])
            ->latest()
            ->get();
    }

    public function store(array $data) :Ticket
    {
        return $this->model->create($data);
    }

    public function findById(int $id) :?Ticket
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function update(int $id, array $data)  :?Ticket
    {
        try {
            $ticket = $this->findById($id);
            $ticket->update($data);
            return $ticket->refresh();
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function delete(int $id) :void
    {
        $ticket = $this->findById($id);
        $ticket->delete();
    }

    public function ticketsPerStatus(int $statusId) :Collection
    {
        return $this->model->where('status_id', $statusId)
            ->with(['user', 'status', 'priority', 'createdBy', 'updatedBy'])
            ->get();
    }

    public function countPerStatus(int $statusId) :int
    {
        return $this->model->where('status_id', $statusId)->count();
    }
}
