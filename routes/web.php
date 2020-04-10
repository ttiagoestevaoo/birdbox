<?php
   

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/tasks','TasksController@index');
    Route::post('/tasks','TasksController@store');
    Route::get('/projects', 'ProjectsController@index')->name('projects');
    Route::get('/projects/create', 'ProjectsController@create');
    Route::get('/projects/{project}/edit', 'ProjectsController@edit');
    Route::get('/projects/{project} ', 'ProjectsController@show');
    Route::post('/projects','ProjectsController@store');
    Route::patch('/projects/{project}','ProjectsController@update');
    Route::delete('/projects/{project}','ProjectsController@destroy');
    Route::post('/projects/{project}/invitations','ProjectsInvitationsController@store');
    Route::post('/projects/{project}/tasks','ProjectsTasksController@store');
    Route::patch('/projects/{project}/tasks/{task}','ProjectsTasksController@update');
});


Auth::routes();


