<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ticket;

class ProcessTicketsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process 5 unprocessed tickets';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tickets = Ticket::where('status', false)
                         ->oldest()
                         ->take(5)
                         ->get();

        $processedCount = 0;

        foreach ($tickets as $ticket) {
            $ticket->status = true;
            $ticket->save();
            $processedCount++;  
        }

        $this->info("Processed {$processedCount} tickets.");

        return Command::SUCCESS;
    }
}
