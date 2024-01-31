<?php

namespace App\Http\Controllers;

use App\Services\ToDoListService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ToDoListController extends Controller
{
    private ToDoListService $todolistService;

    /**
     * @param ToDoListService $todolistService
     */
    public function __construct(ToDoListService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    /**
     * Displaying ToDo List page.
     * 
     * @param Request $request
     * @return Response
     */
    public function todoList(Request $request): Response
    {
        $todolist = $this->todolistService->getTodolist();

        return response()->view(view: 'todolist.todolist', data: [
            'title' => "ToDoList",
            'todolist' => $todolist
        ]);
    }

    /**
     * Add ToDo to list.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function addTodo(Request $request): RedirectResponse
    {
        $todo = $request->input(key: 'todo');

        if (empty($todo)) {
            $todolist = $this->todolistService->getTodolist();
            return response()->view(view: 'todolist.todolist', data: [
                'title' => "ToDoList",
                'todolist' => $todolist,
                'error' => "Todo is required"
            ]);
        }

        $this->todolistService->saveTodo(id: uniqid(), todo: $todo);

        return redirect()->action(action: [ToDoListController::class, 'todoList']);
    }

    /**
     * Remove todo from the list.
     * 
     * @param Request $request
     * @param string $todoId
     * @return RedirectResponse
     */
    public function removeTodo(Request $request, string $todoId): RedirectResponse
    {
        $this->todolistService->removeTodo($todoId);
        return redirect()->action([ToDoListController::class, 'todoList']);
    }
}
