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
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use Mockery;


class TicketsServiceTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_update_ticket_test()
    {
        $ticket = Ticket::factory()->create();

        $data = [
            'title' => 'Ticket title updated',
        ];

        $mockedTicketRepositoryInterface = Mockery::mock(TicketRepositoryInterface::class, function ($mock) use($data, $ticket) {
            $mock->shouldReceive('update')
                ->withArgs([1, $data])
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
        $result = $ticketService->update(1, $data);
        $this->assertInstanceOf(Ticket::class, $result);
    }

    /** @test */
    public function can_delete_ticket_test()
    {
        $ticket = Ticket::factory()->create();

        $mockedTicketRepositoryInterface = Mockery::mock(TicketRepositoryInterface::class, function ($mock) use ($ticket) {
            $mock->shouldReceive('delete')
                ->withArgs([1])
                ->shouldReceive('findById')
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
        $result = $ticketService->delete(1);
        $this->assertNull($result);
    }


}
