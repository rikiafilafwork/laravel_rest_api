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
     * test get todo list.
     */
    public function test_get_todos(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/todos');

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
     * test get todo by id.
     */
    public function test_get_todos_detail(): void
    {
        $id = Todo::get()->random()->id;
        $user = User::factory()->create();
        $response = $this->actingAs($user)->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/todos/' . $id);

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
