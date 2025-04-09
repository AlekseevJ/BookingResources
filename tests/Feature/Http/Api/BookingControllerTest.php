<?php

namespace Tests\Feature\Http\Api;

use App\Models\Resource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $BASE_URL = "/api/bookings";

    public function test_that_store_success(): void
    {
        $resource = Resource::factory()->create();
        $user = User::factory()->create();
        $startTime = Date::now()->addHours(1);
        $endTime = Date::now()->addHours(2);

        $response = $this->postJson($this->BASE_URL, [
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['id', 'resource_id', 'user_id', 'start_time', 'end_time']);

        $this->assertDatabaseHas('bookings', [
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'start_time' => $startTime->toISOString(),
            'end_time' => $endTime->toISOString(),
        ]);
    }
}