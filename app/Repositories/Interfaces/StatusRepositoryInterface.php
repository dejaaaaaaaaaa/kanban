<?php

namespace App\Repositories\Interfaces;

use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;

interface StatusRepositoryInterface
{
    public function getAll() :Collection;

    public function findById(int $id) :Status;

    public function first() :Status;
}
