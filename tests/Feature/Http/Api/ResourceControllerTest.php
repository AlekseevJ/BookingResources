<?php

namespace Tests\Feature\Http\Api;

use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $BASE_URL = "/api/resources";

    public function test_that_store_success(): void
    {
        $response = $this->postJson($this->BASE_URL, [
            'name' => 'Conference Room',
            'type' => 'room',
            'description' => 'A large conference room with a projector.',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure( ['id', 'name', 'type', 'description']);

        $this->assertDatabaseHas('resources', [
            'name' => 'Conference Room',
            'type' => 'room',
            'description' => 'A large conference room with a projector.',
        ]);
    }

    public function test_that_index_returns_resources(): void
    {
        Resource::factory()->count(3)->create();

        $response = $this->getJson($this->BASE_URL);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'name', 'type', 'description']]]);
    }
}