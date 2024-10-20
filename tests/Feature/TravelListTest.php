<?php

namespace Tests\Feature;

use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class TravelListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_travels_list_return_paginate_data_correctly(): void
{
    $publictravel=Travel::factory()->create(['is_public' => true]);
    Travel::factory()->create(['is_public' => false]);

    $response = $this->get('/api/travels');

    $response->assertStatus(200)
             ->assertJsonCount(1, 'data') // Assuming your pagination returns 15 items per page
             ->assertJsonPath('data.0.name', $publictravel->name); // Check the last page meta data
}

}