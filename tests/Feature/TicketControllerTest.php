<?php
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->jsonStructure = [
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
    ];
});

test('tickets open endpoint returns paginated tickets', function () {
    // Arrange
    Ticket::factory()->count(50)->create();

    // Act
    $response = $this->getJson("/api/tickets/open?per_page=5");

    // Assert
    $response->assertStatus(200)
        ->assertJsonCount(5, 'data')
        ->assertJsonStructure($this->jsonStructure);
});

test('tickets closed endpoint returns paginated tickets', function () {
    // Arrange
    Ticket::factory()->count(50)->create();

    // Act
    $response = $this->getJson("/api/tickets/closed?per_page=5");

    // Assert
    $response->assertStatus(200)
        ->assertJsonCount(5, 'data')
        ->assertJsonStructure($this->jsonStructure);
});

test('open tickets endpoint returns empty when there are no tickets', function () {
    $response = $this->getJson("/api/tickets/closed");

    $response->assertStatus(200)
        ->assertJsonCount(0, 'data')
        ->assertJson(['total' => 0]);
});

test('closed tickets endpoint returns empty when there are no tickets', function () {
    $response = $this->getJson("/api/tickets/closed");

    $response->assertStatus(200)
        ->assertJsonCount(0, 'data')
        ->assertJson(['total' => 0]);
});

test('open tickets endpoint returns tickets when they exist', function () {
    Ticket::factory()->count(3)->open()->create();

    $response = $this->getJson("/api/tickets/open");

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJson(['total' => 3]);
});

test('closed tickets endpoint returns tickets when they exist', function () {
    Ticket::factory()->count(3)->closed()->create();

    $response = $this->getJson("/api/tickets/closed");

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJson(['total' => 3]);
});