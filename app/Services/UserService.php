<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Str;


class UserService
{
    /**
    *
    * @var UserRepository $userRepository
    */
    protected $userRepository;

    /**
     * UserService constructor.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() :Collection
    {
        return $this->userRepository->getAll();
    }

    public function findById(int $id) :?User
    {
        return $this->userRepository->findById($id);
    }

    public function store(array $data) :User
    {
        $data['api_token'] = Str::random(60);
        $data['password'] = Str::random(60);
        return $this->userRepository->store($data);
    }

    public function update(int $id, array $data) :?User
    {
        return $this->userRepository->update($id, $data);
    }

    public function delete(int $id) :void
        {
            $this->userRepository->delete($id);
        }
}
