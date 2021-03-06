<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* HOME */
Route::get('/', array('as' => 'home','uses' => 'HomeController@showWelcome'));

/* PROJECTS */
Route::resource('project', 'ProjectController');

/* USERS IN PROJECTS */
Route::post('project/{id}/add', 'ProjectController@addUser');
Route::post('project/{id}/delete/{idUser}', 'ProjectController@deleteUser');

/* US */
Route::resource('project.userstory', 'UserStoryController');

/* Sprint */
Route::resource('project.sprint', 'SprintController');
Route::get('project/{id}/sprint/{idSprint}/add/{idUS}', 'SprintController@addUserStory');
Route::get('project/{id}/sprint/{idSprint}/delete/{idUS}', 'SprintController@deleteUserStory');
Route::get('project/{id}/sprint/{idSprint}/kanban', 'SprintController@makeKanban');
Route::get('project/{id}/sprint/{idSprint}/pert', 'SprintController@makePert');
Route::get('project/{id}/sprint/{idSprint}/burndownchart', 'SprintController@makeBurnDownChart');

/* USERS */
Route::resource('users', 'UserController');

/* TASKS */
Route::resource('project.userstory.task','TaskController');

/* TESTS */
Route::resource('project.userstory.test','TestController',
    array('except' => array('index', 'show')));

/* Login */
Route::get('login', 'LoginController@index')->before('guest');
Route::post('login','LoginController@post');
Route::get('logout', array('as' => 'logout', function () {
    Auth::logout();
    return Redirect::route('home')->with('message', 'Vous vous êtes bien déconnecté.');
}))->before('auth');