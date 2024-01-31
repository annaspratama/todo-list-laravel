<?php

namespace App\Services;

interface ToDoListService
{
    /**
     * Save todo to storage.
     * 
     * @param string $id
     * @param string $todo
     * @return void
     */
    public function saveTodo(string $id, string $todo): void;

    /**
     * Get todo.
     * 
     * @return array
     */
    public function getTodolist(): array;

    /**
     * Remove todo from storage.
     * 
     * @param string $todoId
     * @return void
     */
    public function removeTodo(string $todoId): void;

}