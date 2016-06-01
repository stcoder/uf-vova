<?php

use App\Option;

Admin::menu()->url('/')->label('Dashboard')->icon('fa-dashboard');
Admin::menu()->url('integration')->label('Интеграция')->icon('fa-angle-double-up')->items(function() {
    Admin::menu()->url('integration')->label('Подключение')->icon('fa-plus');
    if (\DB::getDoctrineSchemaManager()->tablesExist('options')) {
        if (!is_null(Option::get('vk-user-id')) && !is_null(Option::get('vk-group-id'))) {
            Admin::menu(\App\Post::class)->label('Посты')->icon('fa-file-text-o');

            if (!is_null(Option::get('vk-board-topic-id'))) {
                Admin::menu(\App\Review::class)->label('Отзывы')->icon('fa-comments-o');
            }
        }
    }
});
Admin::menu(\App\Page::class)->label('Страницы')->icon('fa-file-text');
Admin::menu(\App\Slide::class)->label('Слайды')->icon('fa-picture-o');