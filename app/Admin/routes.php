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

Route::get('integration/imports', [
	'as' => 'admin.integration.imports',
	'uses' => '\App\Http\Controllers\Admin\Imports@main'
]);

Route::get('integration/imports/posts', [
	'as' => 'admin.integration.imports.posts',
	'uses' => '\App\Http\Controllers\Admin\Imports@posts'
]);

Route::get('integration/imports/posts/import', [
	'as' => 'admin.integration.imports.posts.import',
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