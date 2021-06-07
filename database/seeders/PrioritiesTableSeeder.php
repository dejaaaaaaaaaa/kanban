<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class PrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'To do',
            'In progress',
            'Done',
        ];

        foreach ($statuses as $status){
            Status::factory()->create([
                'status' => $status,
            ]);
        }

    }
}
