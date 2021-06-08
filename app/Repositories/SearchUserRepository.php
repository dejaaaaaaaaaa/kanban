<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\SearchUserRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SearchUserRepository  implements SearchUserRepositoryInterface
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

    public function search(string $search): Collection
    {
        return $this->model
            ->where(DB::raw('lower(name)'), 'like', '%' . strtolower($search) . '%')
            ->orWhere(DB::raw('lower(email)'), 'like', '%' . strtolower($search) . '%')
            ->get();
    }
}
