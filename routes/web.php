<?php

use Inertia\Inertia;
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

Route::get('login/google', 'LoginController@redirectToProvider');
Route::get('login/google/callback', 'LoginController@handleProviderCallback');

Route::get('/', 'DashboardController@index');


// User Tasks
Route::post('/users/{user}/tasks/', 'UserTasksController@store');
Route::patch('/users/{user}/tasks', 'UserTasksController@update');
Route::delete('/users/{user}/tasks/{task}', 'UserTasksController@destroy');
