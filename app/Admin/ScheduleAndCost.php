<?php

/** @var \SleepingOwl\Admin\Model\ModelConfiguration $mdenu */
$model = Admin::model(\App\ScheduleAndCost::class);
$model->title('Блок расписание и стоимость');
$model->display(function() {
    $display = AdminDisplay::datatables();
    $display->columns([
        Column::string('title')->label('Заголовок')->orderable(false),
        Column::datetime('created_at')->label('Создан')->orderable(false),
        Column::order()->orderable(false)
    ]);
    $display->apply(function(\Illuminate\Database\Eloquent\Builder $query) {
        $query->withTrashed();
        $query->orderBy('order', 'asc');
    });
    return $display;
})->createAndEdit(function($id) use($model) {
    $model->title($id ? 'Редактировать блок' : 'Создать блок');

    $form = AdminForm::form();
    $form->items([
        FormItem::text('title'),
        FormItem::ckeditor('text')
    ]);
    return $form;
});