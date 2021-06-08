<?php

namespace Tests\Unit\Service;

use App\Models\Priority;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class TicketTest
 * @package Tests\Unit\Service
 */
class TicketTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_all_tickets()
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create([
            'title' => 'Title',
            'description' => 'Description of ticket',
            'created_at' => '08-06-2021 11:00',
            'updated_at' => '08-06-2021 11:00',
            'user_id' => $user->id,
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);
        $data = [
            'id' => $ticket->id,
            'title' => 'Title',
            'description' => 'Description of ticket',
            'user' => $ticket->user->name,
            'status' => $ticket->status->status,
            'priority' => $ticket->priority->priority,
            'created_at' => '08-06-2021 11:00',
            'created_by' => $user->name,
            'updated_at' => '08-06-2021 11:00',
            'updated_by' => $user->name,
        ];


        $this->json('GET', '/api/tickets?api_token='.$user->api_token)
            ->assertStatus(200)
            ->assertJson([$data]);
    }

    /** @test */
    public function can_get_ticket_by_id()
    {
        $user = user::factory()->create();

        $ticket = Ticket::factory()->create([
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);

        $this->json('GET', '/api/tickets/'.$ticket->id.'?api_token='.$user->api_token)
            ->assertStatus(200)
            ->assertJson([
                'id' => $ticket->id,
                'title' => $ticket->title,
                'description' => $ticket->description,
                'user' => $ticket->user->name,
                'status' => $ticket->status->status,
                'priority' => $ticket->priority->priority,
                'created_at' => $ticket->created_at->format('d-m-Y H:i'),
                'created_by' => $user->name,
                'updated_at' => $ticket->updated_at->format('d-m-Y H:i'),
                'updated_by' => $user->name
            ]);
    }

    /** @test */
    public function can_save_ticket()
    {
        $user = User::factory()->create();
        Status::factory()->create();
        Priority::factory()->create();
        $data = [
            'title' => 'Title',
            'description' => 'Description of ticket',
        ];

        $this->json('POST', '/api/tickets?api_token='.$user->api_token, $data)
            ->assertStatus(200);
    }

    /** @test */
    public function can_update_ticket()
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create();
        Status::factory()->create();
        Priority::factory()->create();
        $data = [
            'title' => 'Title Update',
            'description' => 'Description of ticket',
        ];

        $this->json('PUT', '/api/tickets/'.$ticket->id.'?api_token='.$user->api_token, $data)
            ->assertStatus(200);
    }

    /** @test */
    public function can_delete_ticket()
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create();

        $this->json('DELETE', '/api/tickets/'.$ticket->id.'?api_token='.$user->api_token)
            ->assertStatus(200);
    }

}
