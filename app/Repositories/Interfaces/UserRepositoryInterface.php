<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAll() :Collection;

    public function store(array $data) :User;

    public function findById(int $id) :User;

    public function update(int $id, array $data) :User;

    public function delete(int $id) :void;
}
