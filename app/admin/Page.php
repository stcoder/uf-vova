<?php

Admin::model('\App\Page')->title('Страницы')->with()->filters(function ()
{
	ModelItem::filter('id')->title()->from('\App\Page', 'title');
})->columns(function ()
{
	Column::string('id', 'ID');
	Column::string('title', 'Заголовок');
	Column::published('published', 'Опубликован');
	Column::date('created_at', 'Создан')->formatDate('long')->formatTime('short');
	Column::action('show', 'Открыть')->url(function($instance) {
		return route('page', ['page' => $instance->slug]);
	});
})->form(function ()
{
	FormItem::text('title', 'Заголовок')->required();
	FormItem::checkbox('published', 'Опубликовать');
	FormItem::ckeditor('content', 'Содержание')->required();
});