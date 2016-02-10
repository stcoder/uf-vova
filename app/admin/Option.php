<?php

Admin::model('\App\Option')->title('Опции')->with()->filters(function ()
{

})->columns(function ()
{
	Column::string('title', 'Заголовок');
	Column::option_value('value', 'Значение');
})->form(function ()
{
	FormItem::text('name', 'Название ключа');
	FormItem::text('title', 'Заголовок');
	FormItem::option_value()->init('value', 'Значение');
});