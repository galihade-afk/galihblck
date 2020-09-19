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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->group(function ()
{
    Route::get('/', 'HomeController@index');//localhost:8000/Home

    Route::prefix('profile')->group(function ()
    {
        Route::get('/', 'HomeController@profile')->name('profile');
        Route::post('update', 'HomeController@update_profile');
    });

    Route::prefix('todo-list')->group(function ()
    {
        Route::get('/', 'HomeController@todo_list')->name('todo');
        Route::get('/list', 'HomeController@list')->name('todo.list');
        Route::post('upload', 'HomeController@todo_upload')->name('todo.upload');
        Route::post('api', 'HomeController@api')->name('todo.api');
        Route::post('delete', 'HomeController@delete')->name('todo.delete');
        Route::post('edit', 'HomeController@edit')->name('todo.edit');
        Route::post('update', 'HomeController@todo_update')->name('todo.update');
        Route::post('reminder', 'HomeController@reminder')->name('reminder.alert');
    });

    
});