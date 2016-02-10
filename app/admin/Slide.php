<?php

Admin::model('\App\Slide')->title('Слайды')->with('page')->filters(function ()
{
})->columns(function ()
{
	Column::image('image', 'Картинка');
	Column::string('title', 'Заголовок');
	Column::string('description', 'Описание');
	Column::string('page.title', 'Страница')->append(Column::filter('id')->value('page_id')->model('\App\Page'));
})->form(function ()
{
	FormItem::text('title', 'Заголовок')->required();
	FormItem::textarea('description', 'Описание');
	FormItem::select('page_id', 'Страница')->list('\App\Page')->required();
	FormItem::image('image', 'Картинка')->required(true);
})->async(true);