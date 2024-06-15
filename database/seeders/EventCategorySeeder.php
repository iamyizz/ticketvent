<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventCategory;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventCategory::create([
            'name' => 'Musik',
        ]);
        
        EventCategory::create([
            'name' => 'Pameran',
        ]);

        EventCategory::create([
            'name' => 'Expo',
        ]);
    }
}
