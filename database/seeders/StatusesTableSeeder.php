<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $priorities = [
            'blue' => 'Low',
            'orange' => 'Medium',
            'red' => 'High',
        ];

        foreach ($priorities as $color => $priority){
            Priority::factory()->create([
                'priority' => $priority,
                'color' => $color,
            ]);
        }
    }
}
