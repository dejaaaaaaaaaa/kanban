<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface SearchUserRepositoryInterface
{
    public function search(string $search) :Collection;
}
