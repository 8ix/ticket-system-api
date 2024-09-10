<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('open tickets endpoint returns 200 status code', function () {
    $response = $this->get('/api/tickets/open');
    $response->assertStatus(200);
});

test('closed tickets endpoint returns 200 status code', function () {
    $response = $this->get('/api/tickets/closed');
    $response->assertStatus(200);
});

test('user tickets endpoint returns 200 status code', function () {
    $user = User::factory()->create();
    $response = $this->get("/api/users/{$user->id}/tickets");
    $response->assertStatus(200);
});

test('stats endpoint returns 200 status code', function () {
    $response = $this->get('/api/stats');
    $response->assertStatus(200);
});