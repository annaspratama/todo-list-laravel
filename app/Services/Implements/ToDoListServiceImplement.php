<?php

namespace App\Services\Implements;

use App\Services\ToDoListService;
use Illuminate\Support\Facades\Session;

class ToDoListServiceImplement implements ToDoListService
{

    public function saveTodo(string $id, string $todo): void
    {
        if (!Session::exists(key: 'todolist')) {
            Session::put(key: 'todolist', value: []);
        }

        Session::push(key: 'todolist', value: [
            'id' => $id,
            'todo' => $todo
        ]);
    }

    public function getTodolist(): array
    {
        return Session::get(key: 'todolist', default: []);
    }

    public function removeTodo(string $todoId): void
    {
        $todolist = Session::get(key: 'todolist');

        foreach ($todolist as $index => $value) {
            if ($value['id'] == $todoId) {
                unset($todolist[$index]);
                break;
            }
        }

        Session::put(key: 'todolist', value: $todolist);
    }
}