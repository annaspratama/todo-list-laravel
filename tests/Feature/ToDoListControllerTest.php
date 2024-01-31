<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToDoListControllerTest extends TestCase
{
    /**
     * Test check check saved session.
     * 
     * @return void
     */
    public function testTodolist(): void
    {
        $this->withSession(data: [
            'username' => "annas",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Annas"
                ],
                [
                    "id" => "2",
                    "todo" => "Pratama"
                ]
            ]
        ])->get(uri: '/todolist')
            ->assertSeeText(value: "1")
            ->assertSeeText(value: "Annas")
            ->assertSeeText(value: "2")
            ->assertSeeText(value: "Pratama");
    }

    /**
     * Test for add todo is failed.
     * 
     * @return void
     */
    public function testAddTodoFailed(): void
    {
        $this->withSession(data: [
            'username' => "annas"
        ])
            ->post(uri: '/todolist', data: [])
            ->assertSeeText(value: "Todo is required");
    }

    /**
     * Test for add todo is succeed.
     * 
     * @return void
     */
    public function testAddTodoSuccess(): void
    {
        $this->withSession([
            'username' => "annas"
        ])->post(uri: '/todolist', data: [
            'todo' => "Annas"
        ])->assertRedirect(uri: '/todolist');
    }

    /**
     * Test for remove todo.
     * 
     * @return void
     */
    public function testRemoveTodolist(): void
    {
        $this->withSession([
            'username' => "annas",
            'todolist' => [
                [
                    'id' => "1",
                    'todo' => "Annas"
                ],
                [
                    'id' => "2",
                    'todo' => "Pratama"
                ]
            ]
        ])
            ->post(uri: '/todolist/1/delete')
            ->assertRedirect(uri: '/todolist');
    }
}