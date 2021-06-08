<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Requests\TicketCreateRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\Services\TicketService;

use Illuminate\Http\JsonResponse;
use Psy\Util\Json;

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

    public function show(int $id) :JsonResponse
    {
        $ticket = $this->ticketService->findById($id);
        if($ticket){
            return response()->json(TicketResource::make($ticket));
        }
        return response()->json('Ticket not found!');
    }

    public function update(TicketUpdateRequest $request, $id) :JsonResponse
    {
        $data = $request->validated();
        $ticket = $this->ticketService->update($id, $data);
        if($ticket){
            return response()->json(TicketResource::make($ticket));
        }
        return response()->json('Ticket not updated!');
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
