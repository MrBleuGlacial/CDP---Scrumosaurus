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

/* US */
Route::resource('project.userstory', 'UserStoryController',
    array('except' => array('index')));

/* PROJECTS */
Route::resource('project', 'ProjectController');

/* USERS */
Route::resource('users', 'UserController');

/* TASKS */
Route::resource('task','TaskController');

/* Login */
Route::get('login', 'LoginController@index');
Route::post('login','LoginController@post');
Route::get('logout', array('as' => 'logout', function () {
    Auth::logout();
    return Redirect::route('home')->with('flash_notice', 'You are successfully logged out.');
}))->before('auth');