<?php

/**
 * @var \SleepingOwl\Admin\Model\ModelConfiguration
 */
$model = Admin::model(\App\Slide::class);
$model->title('Слайды');
$model->display(function(){
	$display = AdminDisplay::datatables();
	$display->with('page');
	$display->columns([
		Column::image('image')->label('Картинка')->orderable(false),
		Column::string('title')->label('Заголовок')->orderable(false),
		Column::string('description')->label('Описание')->orderable(false),
		Column::string('page.title')->label('Страница')->append(Column::filter('id')->model(\App\Page::class)->field('page_id'))->orderable(false),
		Column::order()->orderable(false)
	]);
	$display->apply(function($query) {
		$query->orderBy('sort', 'asc');
	});
	return $display;
});
$model->createAndEdit(function($id) use($model) {
	$model->title($id ? 'Редактировать слайд' : 'Создать слайд');

	$form = AdminForm::form();

	$form->items([
		FormItem::columns()->columns([
			[
				FormItem::text('title', 'Заголовок')->required(),
				FormItem::select('page_id', 'Страница')->model(\App\Page::class)->display('title')->required(),
				FormItem::textarea('description', 'Описание')->rows(4),
			],
			[
				FormItem::image('image', 'Картинка')->required(true),
			]
		])
	]);
	return $form;
});
