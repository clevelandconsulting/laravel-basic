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

/* Home Route */
Route::get('/', array('as'=>'home', "uses"=>"HomeController@showMain"));

/* Routes for logging in and out */
Route::get('login', array('as'=>'login', "uses"=>"LoginController@showLogin"))->before('guest');
Route::post('login', "LoginController@doLogin");
Route::get('logout',array('as'=>'logout',"uses"=>"LoginController@doLogout"))->before('auth');

/*Routes for the Profile*/
Route::get('profile', array('as'=>'profile', "uses"=>"ProfileController@showProfile"))->before('auth');
Route::put('updateuser', array('as'=>'updateuser', 'uses'=>'ProfileController@updateProfile'))->before('auth');