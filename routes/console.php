<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\GenerateTicketCommand;
use App\Console\Commands\ProcessTicketsCommand;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::Command(GenerateTicketCommand::class)->everyMinute();
Schedule::Command(ProcessTicketsCommand::class)->everyFiveMinutes();
