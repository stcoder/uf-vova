<?php

/**
 * @var \SleepingOwl\Admin\Model\ModelConfiguration
 */
$model = Admin::model(\App\Page::class);
$model->title('Страницы');
$model->display(function() {
    $display = AdminDisplay::datatables();
    $display->filters([
        Filter::field('id')->title(function($value) {
            return 'Выбрана страница с идентификатором: ' . $value;
        })
    ]);
    $display->columns([
        Column::string('title')->label('Заголовок'),
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
            FormItem::checkbox('published', 'Опубликовать'),
            FormItem::ckeditor('content', 'Содержимое')
        ],
        'Мета данные' => [
            FormItem::textarea('meta_keywords', 'Ключевые слова')->rows(2),
            FormItem::textarea('meta_description', 'Описание страницы')->rows(4),
            FormItem::textarea('meta_others', 'Другая мета информация')->rows(7)
        ]
    ]);
    return $form;
});
