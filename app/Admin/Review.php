<?php

$model = Admin::model(\App\Review::class);
$model->title('Отзывы');
$model->display(function() {
    $display = AdminDisplay::tabbed();
    $display->tabs(function() {
        $tabs = [];
        $mainDisplay = AdminDisplay::datatables();
        $mainDisplay->with('profile');
        $mainDisplay->columns([
            Column::checkbox(),
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

        $mainDisplay->order([2, 'desc']);

        $mainDisplay->actions([
            Column::action('review_import')->value('Импортировать записи')->icon('fa-share')->callback(function (\Illuminate\Database\Eloquent\Collection $collection) {
                \App\Imports\Review::import(0, 100);
            }),
            Column::action('review_trashed')->value('Удалить записи')->icon('fa-times')->callback(function(\Illuminate\Database\Eloquent\Collection $collections) {
                if ($collections) {
                    /** @var \App\Post $collection */
                    foreach($collections as $collection) {
                        $collection->delete();
                    }
                }
            })
        ]);

        $secondaryDisplay = AdminDisplay::datatables();
        $secondaryDisplay->apply(function($query) {
            $query->onlyTrashed();
        });
        $secondaryDisplay->with('profile');
        $secondaryDisplay->columns([
            Column::checkbox(),
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
            Column::datetime('created_at')->label('Импортирован')->format('d.m.Y в H:i'),
            Column::datetime('deleted_at')->label('Удален')->format('d.m.Y в H:i')
        ]);

        $secondaryDisplay->order([2, 'desc']);

        $secondaryDisplay->actions([
            Column::action('review_import')->value('Импортировать записи')->icon('fa-share')->callback(function (\Illuminate\Database\Eloquent\Collection $collection) {
                \App\Imports\Review::import(0, 100);
            }),
            Column::action('review_restore')->value('Восстановить записи')->icon('fa-refresh')->callback(function(\Illuminate\Database\Eloquent\Collection $collections) {
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