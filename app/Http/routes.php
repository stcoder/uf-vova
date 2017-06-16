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

Route::get('/', [
	'as' => 'home',
	'uses' => 'HomeController@index'
]);

Route::get('/o-klube.html', ['as' => 'about', function() {
	return view('about', ['histories' => \App\HistoryDate::orderBy('order', 'asc')->get()]);
}]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/novosti', ['as' => 'news.dashboard', 'uses' => '\App\Http\Controllers\NewsController@dashboard']);

Route::get('/novosti/{date}/{news}.html', ['as' => 'news', 'uses' => '\App\Http\Controllers\NewsController@detail']);

Route::post('/feedback/add', ['as' => 'feedback.add', 'uses' => '\App\Http\Controllers\FeedbackController@add']);

Route::get('{page}.html', ['as' => 'page', 'uses' => '\App\Http\Controllers\PageController@showPage']);

Route::get('show_attachment', [
	'as' => 'attachment_show',
	'uses' => 'AttachmentController@show'
]);

Route::get('post-show_pid{pid}', [
	'as' => 'post_show',
	'uses' => 'PostController@show'
]);

Route::get('get_audio{id}', [
	'as' => 'audio_get',
	'uses' => 'AttachmentController@getAudio'
]);

Route::get('load-video-vid{vid}', [
	'as' => 'load_video',
	'uses' => 'AttachmentController@loadVideo'
]);

Route::get('load-audio-aid{aid}', [
	'as' => 'load_audio',
	'uses' => 'AttachmentController@loadAudio'
]);

Route::get('load_next_posts', [
	'as' => 'load_next_posts',
	'uses' => 'HomeController@loadNextPosts'
]);

Route::get('load_review', [
	'as' => 'load_review',
	'uses' => 'HomeController@loadReview'
]);