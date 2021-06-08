<?php

namespace App\Repositories\Interfaces;

use App\Models\Ticket;

use Illuminate\Database\Eloquent\Collection;

interface TicketRepositoryInterface
{
    public function getAll() :Collection;

    public function store(array $data) :Ticket;

    public function findById(int $id) :Ticket;

    public function update(int $id, array $data) :Ticket;

    public function delete(int $id) :void;

    public function ticketsPerStatus(int $statusId) :Collection;

    public function countPerStatus(int $statusId) :int;
}
