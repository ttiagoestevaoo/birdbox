<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageTasksApiTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function a_user_can_get_tasks()
    {
        $this->withoutExceptionHandling();
        $this->get('/api/tasks')->assertJson();
    }

    public function a_user_can_create_tasks() {

        $data = [
            'body' => $this->faker->sentence
        ];

        $this->post('/api/tasks', $data)
            ->assertStatus(200)
            ->assertJson($data);
    }
}
