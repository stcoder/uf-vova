<?php

/**
 * @var \SleepingOwl\Admin\Model\ModelConfiguration
 */
use Carbon\Carbon;

$model = Admin::model(\App\Post::class);
$model->title('Посты');
$model->display(function() {
    $display = AdminDisplay::datatables();
    $display->columns([
        Column::string('id'),
        Column::custom()->label('Картинка')->callback(function($instance) {
            $attachment = $instance->attachments()->first();
            if (!is_null($attachment)) {
                if ($attachment->type === 'album') {
                    $attachment = $attachment->childs()->first();
                }
                return "<img class='thumbnail' width='80px' src='{$attachment->srcs['image_small']}'>";
            }
            return '';
        }),
        Column::custom()->label('Текст')->callback(function($instance) {
            return str_limit($instance->text, 180);
        }),
        Column::count('attachments')->label('Вложений'),
        Column::datetime('date')->label('Создан')->format('d.m.Y в H:i'),
        Column::datetime('created_at')->label('Импортирован')->format('d.m.Y в H:i')
    ]);

    $display->actions([
        Column::action('post_import')->value('Импортировать записи')->icon('fa-share')->target('_blank')->callback(function ($collection) {
            \App\Imports\Post::import(0, 20);
        })
    ]);

    $display->order([3, 'desc']);

    return $display;
});