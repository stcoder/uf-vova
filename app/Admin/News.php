<?php

/**
 * @var \SleepingOwl\Admin\Model\ModelConfiguration
 */
$model = Admin::model(\App\News::class);
$model->title('Новости');
$model->display(function() {
  $display = AdminDisplay::datatables();
    $display->filters([
        Filter::field('id')->title(function($value) {
            return 'Выбрана новость с идентификатором: ' . $value;
        })
    ]);
    $display->columns([
        Column::image('header_image')->label('Картинка')->orderable(false),
        Column::string('title')->label('Заголовок'),
        Column::string('short_content')->label('Краткое содержание'),
        Column::published('published')->label('Опубликован')->orderable(false),
        Column::datetime('created_at')->label('Создан')->format('d.m.Y в H:i')
    ]);
    $display->columnFilters([
        null,
        ColumnFilter::select()->options(['нет' => 'Нет', 'да' => 'Да'])->filter_field('published')
    ]);
    return $display;
})->createAndEdit(function($id) use($model) {
  $model->title($id ? 'Редактировать страницу' : 'Создать страницу');

  $form = AdminForm::tabbed();
    $form->items([
        'Основное' => [
            FormItem::text('title', 'Заголовок')->required(),
            FormItem::image('header_image', 'Картинка в заголовке'),
            FormItem::checkbox('published', 'Опубликовать'),
            FormItem::textarea('short_content', 'Краткое содержание (текст отображается в ленте)')->required(),
            FormItem::ckeditor('content', 'Содержимое')->required()
        ],
        'Мета данные' => [
            FormItem::textarea('meta_keywords', 'Ключевые слова')->rows(2),
            FormItem::textarea('meta_description', 'Описание страницы')->rows(4),
            FormItem::textarea('meta_others', 'Другая мета информация')->rows(7)
        ]
    ]);
    return $form;
});