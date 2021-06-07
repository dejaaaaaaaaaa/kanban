<?php

namespace App\Repositories;

use App\Models\Priority;
use App\Repositories\Interfaces\PriorityRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;

class PriorityRepository  implements PriorityRepositoryInterface
{

    /**
    * @var Priority $model
    */
    private $model;

    /**
     * PriorityRepository constructor.
     * @param Priority $model
     */
    public function __construct(Priority $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->latest()->get();
    }

    public function findById(int $id) :Priority
    {
        return $this->model->findOrFail($id);
    }

    public function first() :Priority
    {
        return $this->model->first();
    }
}
