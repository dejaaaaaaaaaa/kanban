<?php

namespace App\Repositories\Interfaces;

use App\Models\Priority;
use Illuminate\Database\Eloquent\Collection;

interface PriorityRepositoryInterface
{
    public function getAll() :Collection;

    public function findById(int $id) :Priority;

    public function first() :Priority;
}
