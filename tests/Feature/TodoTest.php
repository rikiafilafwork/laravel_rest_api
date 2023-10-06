<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Todo;

class TodoTest extends TestCase
{
    /**
     * test get todo api list.
     */
    public function test_get_todos(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->withHeaders([
            'Accept' => 'application/json',
        ])->getJson('/api/todos');

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'success',
                'message',
                'data' =>  [
                    '*' => [
                        "id",
                        "user_id",
                        "task",
                        "complete",
                        "created_at",
                        "updated_at",
                    ],
                ],
            ]
        );
    }

    /**
     * test get todo api by id.
     */
    public function test_get_todos_detail(): void
    {
        $id = Todo::get()->random()->id;
        $user = User::factory()->create();
        $response = $this->actingAs($user)->withHeaders([
            'Accept' => 'application/json',
        ])->getJson('/api/todos/' . $id);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'success',
                'message',
                'data' =>  [
                    "id",
                    "user_id",
                    "task",
                    "complete",
                    "created_at",
                    "updated_at",
                ],
            ]
        );
    }

    /**
     * test post todo api.
     */
    public function test_post_todos(): void
    {
        $user = User::factory()->create();
        $payload = [
            'user_id' => $user->id,
            'task' => fake()->sentence(3),
            'complete' => rand(0,1)
        ];
        $response = $this->actingAs($user)->withHeaders([
            'Accept' => 'application/json',
        ])->postJson('/api/todos', $payload);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'success',
                'message',
                'data' => [
                    "id",
                    "user_id",
                    "task",
                    "complete",
                    "created_at",
                    "updated_at",
                ],
            ]
        );
    }

    /**
     * test update todo api by id.
     */
    public function test_update_todos(): void
    {
        $id = Todo::get()->random()->id;
        $user = User::factory()->create();
        $payload = [
            'user_id' => $user->id,
            'task' => fake()->sentence(3),
            'complete' => rand(0,1)
        ];
        $response = $this->actingAs($user)->withHeaders([
            'Accept' => 'application/json',
        ])->putJson('/api/todos/' . $id, $payload);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'success',
                'message',
                'data' =>  [
                    "id",
                    "user_id",
                    "task",
                    "complete",
                    "created_at",
                    "updated_at",
                ],
            ]
        );
    }

    /**
     * test delete todo api by id.
     */
    public function test_delete_todos(): void
    {
        $id = Todo::get()->random()->id;
        $user = User::factory()->create();
        $response = $this->actingAs($user)->withHeaders([
            'Accept' => 'application/json',
        ])->deleteJson('/api/todos/' . $id);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'success',
                'message',
                'data' =>  [
                    "id",
                    "user_id",
                    "task",
                    "complete",
                    "created_at",
                    "updated_at",
                ],
            ]
        );
    }
}
