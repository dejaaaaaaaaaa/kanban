<?php

namespace Tests\Feature\Entities;


use App\Models\Priority;
use App\Models\Status;
use App\Models\Ticket;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private $ticket;

    /**
     * Setup test environment for this test
     */
    public function setUp() :void
    {
        parent::setUp();
        $ticket = Ticket::factory()->create();
        $this->ticket = $ticket;

    }

    /** @test */
    public function ticket_has_user()
    {
        $this->assertInstanceOf(
            User::class, $this->ticket->user
        );
    }

    /** @test */
    public function ticket_has_status()
    {
        $this->assertInstanceOf(
            Status::class, $this->ticket->status
        );
    }

    /** @test */
    public function ticket_has_priority()
    {
        $this->assertInstanceOf(
            Priority::class, $this->ticket->priority
        );
    }
}
