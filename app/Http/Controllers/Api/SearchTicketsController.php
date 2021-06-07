<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Services\SearchTicketService;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SearchTicketsController extends Controller
{
    protected $searchTicketService;

    public function __construct(SearchTicketService $searchTicketService)
    {
        $this->searchTicketService = $searchTicketService;
    }

    public function search(Request $request) :JsonResponse
    {
        return response()->json(TicketResource::collection($this->searchTicketService->search($request->phrase)));
    }
}
