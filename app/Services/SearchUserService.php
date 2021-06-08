<?php

namespace App\Services;

use App\Repositories\Interfaces\SearchUserRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;


class SearchUserService
{
    /**
    *
    * @var SearchUserRepository $searchUserRepository
    */
    private $searchUserRepository;

    /**
     * SearchUserService constructor.
     */
    public function __construct(SearchUserRepositoryInterface $searchUserRepository)
    {
        $this->searchUserRepository = $searchUserRepository;
    }

    public function search(string $search) :Collection
    {
        return $this->searchUserRepository->search($search);
    }
}
