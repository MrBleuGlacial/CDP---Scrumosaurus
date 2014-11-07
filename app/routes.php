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
Route::get('/', 'HomeController@showWelcome');

/* PROJECTS */
Route::get('/projects', 'ProjectController@showProject');

Route::get('/projects/create', 'ProjectController@showCreateProject');

Route::post('/projects/create/verify', 'ProjectController@verifyCreateProject');

/* USERS */
Route::get('/register', 'UserController@showRegister');

Route::post('/register/verify', 'UserController@verifyRegistration');
