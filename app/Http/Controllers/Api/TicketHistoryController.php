<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketHistoryResource;
use App\Services\TicketHistoryService;

use Illuminate\Http\JsonResponse;

class TicketHistoryController extends Controller
{
    protected $ticketHistoryService;

    public function __construct(TicketHistoryService $ticketHistoryService)
    {
        $this->ticketHistoryService = $ticketHistoryService;
    }

    public function history(int $ticket) :JsonResponse
    {
        return response()->json(TicketHistoryResource::collection($this->ticketHistoryService->history($ticket)));
    }
}
