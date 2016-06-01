<?php

$model = Admin::model(\App\Review::class);
$model->title('Отзывы');
$model->display(function() {
    $display = AdminDisplay::datatables();
    $display->with('profile');
    $display->columns([
        Column::custom()->label('Автор')->callback(function($instance) {
            $fullName = '<p class="small text-center">' . $instance->profile->first_name . ' ' . $instance->profile->last_name . '</p>';
            $img = '';
            if (!is_null($instance->profile->photo)) {
                $img = "<img class='thumbnail' width='110px' src='{$instance->profile->photo}'>";
            }

            return $img . $fullName;
        }),
        Column::custom()->label('Текст')->callback(function($instance) {
            return str_limit($instance->text, 180);
        }),
        Column::datetime('date')->label('Опубликован')->format('d.m.Y в H:i'),
        Column::datetime('created_at')->label('Импортирован')->format('d.m.Y в H:i')
    ]);

    $display->order([2, 'desc']);

    $display->actions([
        Column::action('review_import')->value('Импортировать записи')->icon('fa-share')->target('_blank')->callback(function ($collection) {
            \App\Imports\Review::import(0, 100);
        })
    ]);

    return $display;
});