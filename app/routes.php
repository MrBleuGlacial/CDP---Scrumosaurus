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

/* US */
Route::resource('project.userstory', 'UserStoryController');

/* Sprint */
Route::resource('project.sprint', 'SprintController');

/* USERS */
Route::resource('users', 'UserController');

/* TASKS */
Route::resource('project.task','TaskController');

/* Login */
Route::get('login', 'LoginController@index')->before('guest');
Route::post('login','LoginController@post');
Route::get('logout', array('as' => 'logout', function () {
    Auth::logout();
    return Redirect::route('home')->with('message', 'Vous vous êtes bien déconnecté.');
}))->before('auth');