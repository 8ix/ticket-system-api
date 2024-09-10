<?php
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('user tickets endpoint returns paginated tickets', function () {
    // Arrange
    Ticket::factory()->count(20)->create(['user_id' => $this->user->id]);

    // Act
    $response = $this->getJson("/api/users/{$this->user->id}/tickets?per_page=10");

    // Assert
    $response->assertStatus(200)
        ->assertJsonCount(10, 'data')
        ->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => ['id', 'subject', 'content', 'status', 'created_at', 'updated_at']
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
        ]);
});

test('user endpoint returns empty when there are no tickets', function () {
    $response = $this->getJson("/api/users/{$this->user->id}/tickets");

    $response->assertStatus(200)
        ->assertJsonCount(0, 'data')
        ->assertJson(['total' => 0]);
});

test('user endpoint returns tickets when they exist', function () {
    Ticket::factory()->count(3)->create(['user_id' => $this->user->id]);

    $response = $this->getJson("/api/users/{$this->user->id}/tickets");

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJson(['total' => 3]);
});

test('user tickets endpoint returns empty when no tickets', function () {
    $response = $this->getJson("/api/users/{$this->user->id}/tickets");

    $response->assertStatus(200)
        ->assertJsonCount(0, 'data')
        ->assertJson(['total' => 0]);
});

test('user tickets endpoint returns 404 for non existent user', function () {
    $response = $this->getJson("/api/users/9999/tickets");
    $response->assertStatus(404);
});



