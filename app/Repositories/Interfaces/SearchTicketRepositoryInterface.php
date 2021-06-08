<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface SearchTicketRepositoryInterface
{
    public function search(string $search) :Collection;
}
