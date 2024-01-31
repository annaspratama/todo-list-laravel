<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get(uri: '/', action: [\App\Http\Controllers\HomeController::class, 'home']); //->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);

Route::view(uri: '/template', view: 'template');

Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
    Route::get(uri: '/login', action: 'login')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    Route::post(uri: '/login', action: 'doLogin')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    Route::post(uri: '/logout', action: 'doLogout')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
});

Route::controller(\App\Http\Controllers\ToDoListController::class)->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class])->group(function () {
        Route::get('/todolist', 'todoList');
        Route::post('/todolist', 'addTodo');
        Route::post('/todolist/{id}/delete', 'removeTodo');
});