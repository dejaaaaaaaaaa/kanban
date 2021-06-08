<?php

namespace Tests\Unit\Service;

use App\Models\Priority;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\Interfaces\PriorityRepositoryInterface;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Services\TicketService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

use Mockery;


class TicketServiceTest extends TestCase
{
       /** @test */
    public function can_get_all_tickets_test()
    {
        $ticket = new Ticket();
        $ticket->title = 'Ticket title';
        $ticket->description = 'Description of ticket';
        $ticket->status_id = 1;
        $ticket->priority_id = 1;

        $mockedTicketRepositoryInterface = Mockery::mock(TicketRepositoryInterface::class, function ($mock) use($ticket) {
            $mock->shouldReceive('getAll')
               ->andReturn(Collection::make($ticket))
               ->getMock();
        });

        $mockedStatusRepositoryInterface = Mockery::mock(StatusRepositoryInterface::class);
        $mockedPriorityRepositoryInterface = Mockery::mock(PriorityRepositoryInterface::class);

        $ticketService = new TicketService(
            $mockedTicketRepositoryInterface,
            $mockedStatusRepositoryInterface,
            $mockedPriorityRepositoryInterface
        );
        $result = $ticketService->index();

        $this->assertJson($result);
    }


    /** @test */
    public function can_get_tickets_by_id_test()
    {
        $ticket = new Ticket();
        $ticket->id = 1;
        $ticket->title = 'Ticket title';
        $ticket->description = 'Description of ticket';
        $ticket->status_id = 1;
        $ticket->priority_id = 1;

        $mockedTicketRepositoryInterface = Mockery::mock(TicketRepositoryInterface::class, function ($mock) use ($ticket) {
            $mock->shouldReceive('findById')
                ->withArgs([1])
                ->andReturn($ticket)
                ->getMock();
        });

        $mockedStatusRepositoryInterface = Mockery::mock(StatusRepositoryInterface::class);
        $mockedPriorityRepositoryInterface = Mockery::mock(PriorityRepositoryInterface::class);

        $ticketService = new TicketService(
            $mockedTicketRepositoryInterface,
            $mockedStatusRepositoryInterface,
            $mockedPriorityRepositoryInterface
        );
        $result = $ticketService->findById(1);

        $this->assertEquals($ticket->title, $result->title);
    }
}
