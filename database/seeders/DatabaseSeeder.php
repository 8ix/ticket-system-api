<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 5 users, each with 5 tickets
        User::factory()
            ->count(5)
            ->has(Ticket::factory()->count(5))
            ->create();

        // Create some processed tickets
        Ticket::factory()
            ->count(10)
            ->processed()
            ->create();
    }
}
