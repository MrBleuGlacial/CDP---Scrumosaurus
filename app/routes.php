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
/*Route::get('/project', 'ProjectController@showProject');*/
/*Route::get('/project/create', 'ProjectController@showCreateProject');*/
/*Route::post('/project/create/verify', 'ProjectController@verifyCreateProject');*/
Route::resource('project', 'ProjectController');

/* USERS */
Route::get('/register', 'UserController@showRegister');

Route::post('/register/verify', 'UserController@verifyRegistration');

/* US */
Route::resource('/userstory', 'UserStoryController');
