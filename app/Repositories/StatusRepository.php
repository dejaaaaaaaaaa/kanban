<?php

namespace App\Repositories;

use App\Models\Status;
use App\Repositories\Interfaces\StatusRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;

class StatusRepository  implements StatusRepositoryInterface
{

    /**
    * @var Status $model
    */
    private $model;

    /**
     * StatusRepository constructor.
     * @param Status $model
     */
    public function __construct(Status $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->latest()->get();
    }

    public function findById(int $id) :Status
    {
        return $this->model->findOrFail($id);
    }

    public function first() :Status
    {
        return $this->model->first();
    }

}
