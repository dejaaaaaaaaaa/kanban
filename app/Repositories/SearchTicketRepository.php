<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Repositories\Interfaces\SearchTicketRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SearchTicketRepository  implements SearchTicketRepositoryInterface
{

    /**
    * @var Ticket $model
    */
    private $model;

    /**
     * TicketRepository constructor.
     * @param Ticket $model
     */
    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }

    public function search(string $search): Collection
    {
        return $this->model
            ->where(DB::raw('lower(title)'), 'like', '%' . strtolower($search) . '%')
            ->orWhere(DB::raw('lower(description)'), 'like', '%' . strtolower($search) . '%')
            ->ofStatusSearch($search)
            ->ofPrioritySearch($search)
            ->get();
    }
}
