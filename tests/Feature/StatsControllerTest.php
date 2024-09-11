<?php

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->jsonStructure = [
        'data' => [
            'total_tickets',
            'unprocessed_tickets',
            'user_with_most_tickets' => [
                'name',
                'email',
                'ticket_count'
            ],
            'last_ticket_processed' => [
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
        ]
    ];
});


test('stats endpoint returns correct structure', function () {

    Ticket::factory()->count(30)->closed()->create();
    Ticket::factory()->count(30)->open()->create();

    $response = $this->getJson("/api/stats");

    $response->assertStatus(200)
        ->assertJsonStructure($this->jsonStructure);
});

test('stats endpoint returns correct ticket quanity values for ticket types', function () {

    Ticket::factory()->count(30)->closed()->create();
    Ticket::factory()->count(30)->open()->create();

    $response = $this->getJson("/api/stats");

    $response->assertStatus(200)
        ->assertJsonStructure($this->jsonStructure)
        ->assertJson([
            'data' => [
                'total_tickets' => 60,
                'unprocessed_tickets' => 30
            ]
        ]);
});