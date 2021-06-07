<?php

namespace Database\Seeders;

use App\Models\Priority;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<=10; $i++){
            $priority = Priority::inRandomOrder()->first();
            $status = Status::inRandomOrder()->first();
            $user = User::first();

            Ticket::factory()->create([
                'priority_id' => $priority->id,
                'status_id'   => $status->id,
                'user_id'     => $user->id,
                'created_by'  => $user->id,
                'updated_by'  => $user->id,
            ]);
        }

    }
}
