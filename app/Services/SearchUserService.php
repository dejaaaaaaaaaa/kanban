<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\PriorityRepositoryInterface;
use App\Repositories\Interfaces\SearchUserRepositoryInterface;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class SearchUserService
{
    /**
    *
    * @var SearchUserRepository $searchUserRepository
    */
    private $searchUserRepository;

    /**
     * @var StatusRepositoryInterface
     */
    private $statusRepository;

    /**
     * @var PriorityRepositoryInterface
     */
    private $priorityRepository;

    /**
     * UserService constructor.
     */
    public function __construct(SearchUserRepositoryInterface $searchUserRepository)
    {
        $this->searchUserRepository = $searchUserRepository;
    }

    public function search($phrase) :Collection
    {
        return $this->searchUserRepository->search($phrase);
    }
}
