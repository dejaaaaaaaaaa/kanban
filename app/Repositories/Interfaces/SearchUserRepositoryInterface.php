<?php

namespace App\Repositories\Interfaces;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;

interface SearchUserRepositoryInterface
{
    public function search(string $phrase) :Collection;
}
