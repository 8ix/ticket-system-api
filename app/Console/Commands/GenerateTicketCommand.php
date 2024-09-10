<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Ticket;

class GenerateTicketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new ticket with data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::inRandomOrder()->first();

        if (!$user) {
            $user = User::factory()->create();
            $this->info('Created a new user as no users existed.');
        }

        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->info('Created a new ticket with ID ' . $ticket->id);

        return Command::SUCCESS;
    }
}
