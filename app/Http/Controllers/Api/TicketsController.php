<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Requests\TicketCreateRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\Services\TicketService;

use Illuminate\Http\JsonResponse;

class TicketsController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function index() :JsonResponse
    {
        return response()->json(TicketResource::collection($this->ticketService->index()));
    }

    public function store(TicketCreateRequest $request) :JsonResponse
    {
        $data = $request->validated();
        return response()->json(TicketResource::make($this->ticketService->store($data)));

    }

    public function show($id)
    {
        return response()->json(TicketResource::make($this->ticketService->findById($id)));
    }

    public function update(TicketUpdateRequest $request, $id) :JsonResponse
    {
        $data = $request->validated();
        return response()->json(TicketResource::make($this->ticketService->update($id, $data)));
    }

    public function destroy($user) :JsonResponse
    {
        $this->ticketService->delete($user);
        return response()->json(['message' => 'Ticket deleted successfully']);
    }

    public function ticketsPerStatus(int $status) :JsonResponse
    {
        return response()->json(TicketResource::collection($this->ticketService->ticketsPerStatus($status)));
    }

    public function ticketsCountPerStatus(int $status) :JsonResponse
    {
        return response()->json($this->ticketService->countPerStatus($status));
    }
}
