<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('user', 'AppController@user');
    Route::post('register', 'AppController@register');
    Route::post('login', 'AppController@login');
    Route::post('logout', 'AppController@logout');
});

Route::get('todolist', [TodoListController::class, 'index']);
Route::post('todolist', [TodoListController::class, 'store']);
Route::patch('todolist/{todo}', [TodoListController::class, 'update']);
Route::delete('todolist/{todo}', [TodoListController::class, 'delete']);
Route::patch('todolist/completed/{todo}', [TodoListController::class, 'completed']);
