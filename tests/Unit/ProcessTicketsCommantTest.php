<?php

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);


test('it processes less than 5 tickets when there are not enough', function () {
    Ticket::factory()->count(5)->open()->create();
    
    $this->artisan('tickets:process')
        ->assertSuccessful()
        ->expectsOutput('Processed 5 tickets.');
    
    expect(Ticket::where('status', true)->count())->toBe(5);
    expect(Ticket::where('status', false)->count())->toBe(0);
});