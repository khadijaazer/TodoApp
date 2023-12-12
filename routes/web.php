<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('todo');
});*/
Route::get('/', [\App\Http\Controllers\TodoController::class, 'index']);

Route::resource('todos', \App\Http\Controllers\TodoController::class); // to access all the functions of the TodoController...
Route::get('todos/{todo}', [\App\Http\Controllers\TodoController::class,'destroy'])->name('todos.destory');
