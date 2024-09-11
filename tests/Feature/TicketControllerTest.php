<?php
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->jsonStructure = [
        'data' => [
            '*' => [
                'id', 
                'subject', 
                'content', 
                'status', 
                'created_at', 
                'updated_at',
                'user' => [
                    'name',
                    'email',
                ]
            ]
        ],
        'meta' => [
            'current_page',
            'from',
            'last_page',
            'links',
            'path',
            'per_page',
            'to',
            'total',
        ],
    ];
});

test('tickets open endpoint returns paginated tickets', function () {
    Ticket::factory()->count(50)->open()->create();

    $response = $this->getJson("/api/tickets/open?per_page=5");

    $response->assertStatus(200)
        ->assertJsonCount(5, 'data')
        ->assertJsonStructure($this->jsonStructure)
        ->assertJson([
            'meta' => ['total' => 50]
        ]);
});

test('tickets closed endpoint returns paginated tickets', function () {
    Ticket::factory()->count(50)->closed()->create();

    $response = $this->getJson("/api/tickets/closed?per_page=5");

    $response->assertStatus(200)
        ->assertJsonCount(5, 'data')
        ->assertJsonStructure($this->jsonStructure)
        ->assertJson([
            'meta' => ['total' => 50]
        ]);
});

test('open tickets endpoint returns empty when there are no tickets', function () {
    $response = $this->getJson("/api/tickets/closed");

    $response->assertStatus(200)
        ->assertJsonCount(0, 'data')
        ->assertJson([
            'meta' => ['total' => 0]
        ]);
});

test('closed tickets endpoint returns empty when there are no tickets', function () {
    $response = $this->getJson("/api/tickets/closed");

    $response->assertStatus(200)
        ->assertJsonCount(0, 'data')
        ->assertJson([
            'meta' => ['total' => 0]
        ]);
});

test('open tickets endpoint returns tickets when they exist', function () {
    Ticket::factory()->count(3)->open()->create();

    $response = $this->getJson("/api/tickets/open");

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJson([
            'meta' => ['total' => 3]
        ]);
});

test('closed tickets endpoint returns tickets when they exist', function () {
    Ticket::factory()->count(3)->closed()->create();

    $response = $this->getJson("/api/tickets/closed");

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJson([
            'meta' => ['total' => 3]
        ]);
});