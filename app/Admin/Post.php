<?php

/**
 * @var \SleepingOwl\Admin\Model\ModelConfiguration
 */
use Carbon\Carbon;

$model = Admin::model(\App\Post::class);
$model->title('Посты');
$model->display(function() {
    $display = AdminDisplay::tabbed();
    $display->tabs(function() {
        $mainDisplay = AdminDisplay::datatables();
        $mainDisplay->columns([
            Column::checkbox(),
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

        $mainDisplay->actions([
            Column::action('post_import')->value('Импортировать последние 10 записей')->icon('fa-share')->callback(function ($collection) {
                \App\Imports\Post::import(0, 10);
            }),
            Column::action('post_trashed')->value('Удалить записи')->icon('fa-times')->callback(function (\Illuminate\Database\Eloquent\Collection $collections) {
                if ($collections) {
                    /** @var \App\Post $collection */
                    foreach($collections as $collection) {
                        $collection->delete();
                    }
                }
            })
        ]);

        $mainDisplay->order([3, 'desc']);

        $secondaryDisplay = AdminDisplay::datatables();
        $secondaryDisplay->apply(function($query) {
            $query->onlyTrashed();
        });
        $secondaryDisplay->columns([
            Column::checkbox(),
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
            Column::datetime('date')->label('Создан')->format('d.m.Y в H:i'),
            Column::datetime('created_at')->label('Импортирован')->format('d.m.Y в H:i'),
            Column::datetime('deleted_at')->label('Удален')->format('d.m.Y в H:i')
        ]);
        $secondaryDisplay->actions([
            Column::action('post_restore')->value('Восстановить записи')->icon('fa-refresh')->callback(function(\Illuminate\Database\Eloquent\Collection $collections) {
                if ($collections) {
                    /** @var \App\Post $collection */
                    foreach($collections as $collection) {
                        $collection->restore();
                    }
                }
            })
        ]);

        $tabs = [];
        $tabs[] = AdminDisplay::tab($mainDisplay)->label('Активные записи')->active(true);
        $tabs[] = AdminDisplay::tab($secondaryDisplay)->label('Удаленные записи');
        return $tabs;
    });
    return $display;
});