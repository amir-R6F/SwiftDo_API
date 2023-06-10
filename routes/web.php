<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TodoController;
use \App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('home');
});

Route::get('new', [TodoController::class, 'new_todo'])->name('addTodo');
Route::get('change', [TodoController::class, 'update_todo'])->name('changeTodo');
Route::get('delete', [TodoController::class, 'delete_todo'])->name('deleteTodo');
Route::get('list', [TodoController::class, 'get_todos'])->name('todoList');

Route::get('cat-list', [CategoryController::class, 'get_categories'])->name('categoryList');
Route::get('new-cat', [CategoryController::class, 'new_category'])->name('newCategory');
Route::get('update-cat', [CategoryController::class, 'update_category'])->name('updateCategory');
Route::get('kill-cat', [CategoryController::class, 'delete_category'])->name('killCategory');
Route::get('cat-todos', [CategoryController::class, 'get_category_todo'])->name('listOfTodo');

Route::get('test', function (\Illuminate\Http\Request $request){
    dd($request->all());
})->name('test');








