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

Route::group(['middleware' => 'guest'], function () {
    Route::get('login/google', 'LoginController@redirectToProvider')->name('login');
    Route::get('login/google/callback', 'LoginController@handleProviderCallback');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    // User Tasks
    Route::post('/users/{user}/tasks/', 'UserTasksController@store');
    Route::patch('/users/{user}/tasks', 'UserTasksController@update');
    Route::delete('/users/{user}/tasks/{task}', 'UserTasksController@destroy');
});
