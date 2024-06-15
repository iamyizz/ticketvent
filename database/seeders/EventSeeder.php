<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'category_id' => '1', 
            'name' => 'Juice WRLD - WRLD Tour', 
            'description' => 'Juice WRLD make the first World Tour in his life.', 
            'image' => '1716484644.jpg', 
            'start_time' => '2024-06-01 13:00:00', 
            'end_time' => '2024-06-01 20:00:00',
        ]);
    }
}
