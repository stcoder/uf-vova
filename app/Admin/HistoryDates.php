<?php

/** @var \SleepingOwl\Admin\Model\ModelConfiguration $model */
$model = Admin::model(\App\HistoryDate::class);
$model->title('История – даты');
$model->display(function() {
    $display = AdminDisplay::datatables();
    $display->columns([
        Column::checkbox(),
        Column::string('title')->label('Заголовок')->orderable(false),
        Column::string('description')->label('Описание')->orderable(false),
        Column::count('events')->label('Событий')->orderable(false),
        Column::datetime('created_at')->label('Создан')->format('d.m.Y в H:i')->orderable(false),
        Column::order()->orderable(false)
    ]);
    $display->order([[5, 'asc']]);
    $display->apply(function(\Illuminate\Database\Eloquent\Builder $query) {
        $query->withTrashed();
    });
    return $display;
})->createAndEdit(function($id) use($model) {
    $model->title($id ? 'Редактировать дату' : 'Создать дату');
    $form = AdminForm::form();
    $form->items([
        FormItem::text('title', 'Заголовок')->required(),
        FormItem::text('description', 'Описание')
    ]);

    return $form;
});