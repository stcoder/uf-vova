<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::get('timeline', function() {
	return view('timeline');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('{page}.html', ['as' => 'page', 'uses' => '\App\Http\Controllers\PageController@showPage']);

Route::get('show_attachment', [
	'as' => 'attachment_show',
	'uses' => 'AttachmentController@show'
]);

Route::get('get_audio{id}', [
	'as' => 'audio_get',
	'uses' => 'AttachmentController@getAudio'
]);

Route::get('load_next_posts', [
	'as' => 'load_next_posts',
	'uses' => 'HomeController@loadNextPosts'
]);