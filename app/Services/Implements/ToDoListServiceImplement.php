<?php

namespace App\Services\Implements;

use App\Models\Todo;
use App\Services\ToDoListService;
use Illuminate\Support\Facades\Session;

class ToDoListServiceImplement implements ToDoListService
{
    public function saveTodo(string $id, string $todo): void
    {
        $todo = new Todo(attributes: [
            'id' => $id,
            'todo' => $todo
        ]);
        $todo->save();
    }

    public function getTodolist(): array
    {
        return Todo::query()->get()->toArray();
    }

    public function removeTodo(string $todoId): void
    {
        $todo = Todo::query()->find(id: $todoId);

        if ($todo != null){
            $todo->delete();
        }
    }

    // public function _saveTodo(string $id, string $todo): void
    // {
    //     if (!Session::exists(key: 'todolist')) {
    //         Session::put(key: 'todolist', value: []);
    //     }

    //     Session::push(key: 'todolist', value: [
    //         'id' => $id,
    //         'todo' => $todo
    //     ]);
    // }

    // public function _getTodolist(): array
    // {
    //     return Session::get(key: 'todolist', default: []);
    // }

    // public function _removeTodo(string $todoId): void
    // {
    //     $todolist = Session::get(key: 'todolist');

    //     foreach ($todolist as $index => $value) {
    //         if ($value['id'] == $todoId) {
    //             unset($todolist[$index]);
    //             break;
    //         }
    //     }

    //     Session::put(key: 'todolist', value: $todolist);
    // }
}