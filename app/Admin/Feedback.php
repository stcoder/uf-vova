<?php

/**
 * @var \SleepingOwl\Admin\Model\ModelConfiguration
 */
$model = Admin::model(\App\Feedback::class);
$model->title('Обратная связь');
$model->display(function() {
    $display = AdminDisplay::datatables();
    $display->columns([
        Column::string('name')->label('Имя')->orderable(false),
        Column::string('age')->label('Возраст'),
        Column::string('phone')->label('Телефон')->orderable(false),
        Column::string('question')->label('Вопрос')->orderable(false),
        Column::sended('sended')->label('Отправлен'),
        Column::datetime('created_at')->label('Создан')->format('d.m.Y в H:i')
    ]);
    $display->columnFilters([
        null,
        null,
        null,
        null,
        ColumnFilter::select()->options(['нет' => 'Нет', 'да' => 'Да'])->filter_field('sended')
    ]);
    return $display;
});