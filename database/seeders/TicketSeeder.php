<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::create([
            'event_id' => '1', 
            'type' => 'Reguler', 
            'price' => '1000000', 
            'quantity' => '200', 
        ]);
    }
}
