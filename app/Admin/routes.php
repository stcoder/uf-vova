<?php

Route::get('', [
	'as' => 'admin.home',
	function () {
		$content = 'Define your dashboard here.';
		return Admin::view($content, 'Dashboard');
	}
]);

Route::get('integration', [
	'as' => 'admin.integration',
	'uses' => '\App\Http\Controllers\Admin\Integration@main'
]);

Route::get('integration/posts', [
	'as' => 'admin.integration.posts',
	'uses' => '\App\Http\Controllers\Admin\Imports@posts'
]);

Route::get('integration/posts/import', [
	'as' => 'admin.integration.posts.import',
	'uses' => '\App\Http\Controllers\Admin\Imports@postsImport'
]);

Route::get('integration/vkontakte', [
	'as' => 'admin.integration.vkontakte',
	'uses' => '\App\Http\Controllers\Admin\Integration@redirectToProvider'
]);

Route::get('integration/vkontakte-off', [
	'as' => 'admin.integration.vkontakte-off',
	'uses' => '\App\Http\Controllers\Admin\Integration@providerOff'
]);

Route::get('integration/vkontakte/callback', [
	'as' => 'admin.integration.vkontakte.callback',
	'uses' => '\App\Http\Controllers\Admin\Integration@handleProviderCallback'
]);

Route::get('integration/group', [
	'as' => 'admin.integration.group',
	'uses' => '\App\Http\Controllers\Admin\Integration@groupSelect'
]);

Route::get('integration/group_{group_id}', [
	'as' => 'admin.integration.group-set',
	'uses' => '\App\Http\Controllers\Admin\Integration@groupSet'
]);

Route::get('integration/group-off', [
	'as' => 'admin.integration.group-off',
	'uses' => '\App\Http\Controllers\Admin\Integration@groupOff'
]);

Route::get('integration/board-topic', [
	'as' => 'admin.integration.board-topic',
	'uses' => '\App\Http\Controllers\Admin\Integration@boardTopic'
]);

Route::get('integration/board-topic_{topic_id}', [
	'as' => 'admin.integration.board-topic-set',
	'uses' => '\App\Http\Controllers\Admin\Integration@boardTopicSet'
]);

Route::get('integration/board-topic-off', [
	'as' => 'admin.integration.board-topic-off',
	'uses' => '\App\Http\Controllers\Admin\Integration@boardTopicOff'
]);