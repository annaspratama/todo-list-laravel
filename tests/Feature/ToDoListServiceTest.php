<?php

namespace Tests\Feature;

use App\Services\ToDoListService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Illuminate\Testing\Assert;
use Tests\TestCase;

class ToDoListServiceTest extends TestCase
{
    private ToDoListService $todolistService;

    /**
     * Setup the test.
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->todolistService = $this->app->make(abstract: ToDoListService::class);
    }

    /**
     * Test ToDoListService is not null.
     * 
     * @return void
     */
    public function testTodolistNotNull(): void
    {
        self::assertNotNull($this->todolistService);
    }

    /**
     * Save todo.
     * 
     * @return void
     */
    public function testSaveTodo(): void
    {
        $this->todolistService->saveTodo(id: "1", todo: "Annas");

        $todolist = $this->todolistService->getTodolist();

        foreach ($todolist as $value){
            self::assertEquals(expected: "1", actual: $value['id']);
            self::assertEquals(expected: "Annas", actual: $value['todo']);
        }
    }

    /**
     * Get todo is empty.
     * 
     * @return void
     */
    public function testGetTodolistEmpty(): void
    {
        self::assertEquals(expected: [], actual: $this->todolistService->getTodolist());
    }

    /**
     * Get todo is not empty.
     * 
     * @return void
     */
    public function testGetTodolistNotEmpty(): void
    {
        $expected = [
            [
                'id' => "1",
                'todo' => "Annas"
            ],
            [
                'id' => "2",
                'todo' => "Pratama"
            ]
        ];

        $this->todolistService->saveTodo(id: "1", todo: "Annas");
        $this->todolistService->saveTodo(id: "2", todo: "Pratama");

        Assert::assertArraySubset(subset: $expected, array: $this->todolistService->getTodolist());
    }

    /**
     * Remove todo.
     * 
     * @return void
     */
    public function testRemoveTodo(): void
    {
        $this->todolistService->saveTodo(id: "1", todo: "Annas");
        $this->todolistService->saveTodo(id: "2", todo: "Pratama");

        self::assertEquals(expected: 2, actual: sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo(todoId: "3");

        self::assertEquals(expected: 2, actual: sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo(todoId: "1");

        self::assertEquals(expected: 1, actual: sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo(todoId: "2");

        self::assertEquals(expected: 0, actual: sizeof($this->todolistService->getTodolist()));
    }
}