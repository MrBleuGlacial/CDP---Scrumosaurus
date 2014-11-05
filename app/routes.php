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

/*Route::get('/', function()
{
	return View::make('hello');
});*/
Route::get('/', 'HomeController@showWelcome');

Route::get('/project', 'ProjectController@showProject');

/*Route::get('/test', function()
{
    return View::make('hello');
});

Route::get('/projet', function(){
    return View::make('layouts.master');
});

Route::get('/backlog/{id}', function($id){
    return 'Backlog '.$id;
    //return View::make('backlog');
});*/