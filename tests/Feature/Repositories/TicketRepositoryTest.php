<?php

namespace Tests\Feature\Repositories;

use App\Models\Priority;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\TicketRepository;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_all_tickets()
    {
        Ticket::factory()->create([
            'title' => 'Ticket title',
        ]);

        $ticketRepository = new TicketRepository(new Ticket());

        $result = $ticketRepository->getAll();

        $this->assertInstanceOf(Ticket::class, $result[0]);

        $this->assertEquals('Ticket title', $result[0]->title);
    }

    /** @test */
    public function can_find_ticket_by_id()
    {
        $ticket = Ticket::factory()->create([
            'title' => 'Test ticket',
            'description' => 'Description of ticket',
        ]);

        $ticketRepository = new TicketRepository($ticket);

        $result = $ticketRepository->findById($ticket->id);

        $this->assertInstanceOf(Ticket::class, $result);

        $this->assertEquals('Test ticket', $result->title);
    }

    /** @test */
    public function can_create_ticket()
    {
        $ticket = new Ticket();
        $user = User::factory()->create();
        $status = Status::factory()->create();
        $priority = Priority::factory()->create();
        $data = [
            'title' => 'Test ticket',
            'description' => 'Description of ticket',
            'status_id' => $status->id,
            'priority_id' => $priority->id,
            'user_id' => $user->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ];
        $ticketRepository = new TicketRepository($ticket);

        $result = $ticketRepository->store($data);

        $this->assertInstanceOf(Ticket::class, $result);

        $this->assertEquals('Test ticket', $result->title);
    }

    /** @test */
    public function can_update_ticket()
    {
        $ticket = Ticket::factory()->create([
            'title' => 'Ticket title'
        ]);

        $ticketRepository = new TicketRepository(new Ticket());

        $result = $ticketRepository->update($ticket->id, ['title' => 'new']);
        $this->assertEquals('new', $result->title);
    }

    /** @test */
    public function can_delete_ticket()
    {
        $ticket = Ticket::factory()->create([
            'title' => 'Ticket title'
        ]);

        $ticketRepository = new TicketRepository(new Ticket());

        $result = $ticketRepository->delete($ticket->id);
        $this->assertNull($result);
    }
}
