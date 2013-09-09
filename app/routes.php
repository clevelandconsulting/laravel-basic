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

/*Routes for notes*/
Route::group(array('prefix'=>'myNotes', 'before'=>'auth'), function() {

	/*display all notes for the user */
	Route::get('',array('as'=>'mynotes','uses'=>'MyNotesController@showAll'));
	
	/*display the form for a making a new note*/
	Route::get('/create',array('as'=>'makenote','uses'=>'MyNotesController@create'));
	
	/*handle the posting of a new note*/
	Route::post('', array('as'=>'addnote','uses'=>'MyNotesController@addFromInput'));
	
	//Routes for dealing with a single note
	Route::group(array('prefix'=>'{id}'), function() {
		//display
		Route::get('',array('as'=>'shownote','uses'=>'MyNotesController@showOne'));
		
		//update
		Route::put('', array('as'=>'updatenote','uses'=>'MyNotesController@updateFromInput'));
		
		//delete
		Route::delete('', array('as'=>'removenote', 'uses'=>'MyNotesController@remove'));
		
		//display edit form
		Route::get('modify', array('as'=>'modifynote','uses'=>'MyNotesController@modify'));
	});
});

/*API ROUTES*/
Route::group(array('prefix'=>'api/v1', 'before'=>'auth'), function() {
	Route::resource('notes', 'API\V1\NotesController');	
});
