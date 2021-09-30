<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }

    public function test_show_this_task_manager_form()
    {
        $response = $this->get(route("tasks.formTask"));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_task_should_be_validate()
    {
        $this->withoutMiddleware();
        $response = $this->postJson(route("tasks.sendMessage"));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_new_task_can_create()
    {
        $this->withoutMiddleware();
        $task = Task::factory(1)->create();
        $response = $this->postJson(route("tasks.sendMessage", [
            'message' => $task[0]->message
        ]));
        $response->assertStatus(302);
    }

}
