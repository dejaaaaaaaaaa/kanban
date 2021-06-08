<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository  implements UserRepositoryInterface
{

    /**
    * @var User $model
    */
    private $model;

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->latest()->get();
    }

    public function store(array $data) :User
    {
        return $this->model->create($data);
    }

    public function findById(int $id) :?User
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function update(int $id, array $data)  :?User
    {
        try {
            $user = $this->findById($id);
            $user->update($data);
            return $user->refresh();
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function delete(int $id) :void
    {
        $user = $this->findById($id);
        $user->delete();
    }
}
