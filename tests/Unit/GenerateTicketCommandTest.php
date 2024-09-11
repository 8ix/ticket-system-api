<?php

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);


test('it creates a ticket for existing user', function () {
    // Arrange
    $user = User::factory()->create();
    
    // Act
    $this->artisan('ticket:generate')
        ->assertSuccessful()
        ->expectsOutput('Created a new ticket with ID 1');
});