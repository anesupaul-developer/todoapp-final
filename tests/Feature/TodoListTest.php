<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_todolist_should_contain_a_title()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->json(
            'post',
            'api/todolist',
            array_merge($this->todolistdata(), ['title' => ''])
        );

        $this->assertCount(0, TodoList::all());
        $response->assertOk();
        $response->assertJson(['status' => false, 'message' => true]);
        $this->assertEquals("The title field is required.", json_decode($response->getContent())->message);
    }

    /** @test */
    public function a_todolist_should_contain_a_description()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->json(
            'post',
            'api/todolist',
            array_merge($this->todolistdata(), ['description' => ''])
        );

        $this->assertCount(0, TodoList::all());
        $response->assertOk();
        $response->assertJson(['status' => false, 'message' => true]);
        $this->assertEquals("The description field is required.", json_decode($response->getContent())->message);
    }

    /** @test */
    public function a_todolist_should_contain_a_duedate()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->json(
            'post',
            'api/todolist',
            array_merge($this->todolistdata(), ['due_date' => ''])
        );

        $this->assertCount(0, TodoList::all());
        $response->assertOk();
        $response->assertJson(['status' => false, 'message' => true]);
        $this->assertEquals("The due date field is required.", json_decode($response->getContent())->message);
    }

    /** @test */
    public function a_loggedin_user_can_create_a_new_todo_list_item()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->json(
            'post',
            'api/todolist',
            $this->todolistdata()
        );

        $this->assertCount(1, TodoList::all());
        $response->assertOk();
        $response->assertJsonStructure(['status', 'message' => [],]);
    }

    /** @test*/
    public function a_user_can_mark_a_todo_as_completed()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api')->json(
            'post',
            'api/todolist',
            $this->todolistdata()
        );

        $response = $this->actingAs($user, 'api')->json(
            'patch',
            'api/todolist/completed/' . TodoList::first()->id
        );

        $this->assertEquals(1, TodoList::first()->is_completed);
        $this->assertCount(1, TodoList::all());
        $response->assertOk();
    }

    /** @test*/
    public function a_user_can_update_a_todo_item()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api')->json(
            'post',
            'api/todolist',
            $this->todolistdata()
        );

        $response = $this->actingAs($user, 'api')->json(
            'patch',
            'api/todolist/' . TodoList::first()->id,
            array_merge($this->todolistdata(), [
                'title' => 'A new title',
                'description' => 'A new description',
                'due_date' => '21-10-2020 17:00:00'
            ])
        );

        $this->assertCount(1, TodoList::all());
        $this->assertEquals('A new title', TodoList::first()->title);
        $this->assertEquals('A new description', TodoList::first()->description);
        $this->assertEquals('2020-10-21 17:00:00', TodoList::first()->due_date);
        $response->assertOk();
    }

    /** @test */
    public function a_user_can_delete_a_todo_item()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api')->json(
            'post',
            'api/todolist',
            $this->todolistdata()
        );

        $response = $this->actingAs($user, 'api')->json(
            'delete',
            'api/todolist/' . TodoList::first()->id
        );

        $this->assertCount(0, TodoList::all());
        $response->assertOk();
    }

    private function todolistdata()
    {
        return [
            'title' => 'Finish assignment',
            'description' => 'This is a Laravel 8.0 project which needs to be emailed to the client 20 October 2020',
            'due_date' => '20-10-2020 17:00:00',
        ];
    }
}
