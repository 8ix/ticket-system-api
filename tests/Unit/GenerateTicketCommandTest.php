<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);


test('it creates a ticket for existing user', function () {

    $user = User::factory()->create();
    
    $this->artisan('ticket:generate')
        ->assertSuccessful()
        ->expectsOutput('Created a new ticket with ID 1');
});