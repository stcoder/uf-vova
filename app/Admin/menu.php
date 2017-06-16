<?php

use App\Option;

Admin::menu()->url('/')->label('Dashboard')->icon('fa-dashboard');
Admin::menu(\App\Page::class)->label('Страницы')->icon('fa-file-text');
Admin::menu(\App\News::class)->label('Новости')->icon('fa-file-text');
Admin::menu(\App\Feedback::class)->label('Обратная связь')->icon('fa-rss');
Admin::menu(\App\Slide::class)->label('Слайды')->icon('fa-picture-o');
Admin::menu(\App\ScheduleAndCost::class)->label('Расписание и стоимость')->icon('fa-list-alt');
Admin::menu()->url('integration')->label('Интеграция')->icon('fa-angle-double-up')->items(function() {
    Admin::menu()->url('integration')->label('Подключение')->icon('fa-plus');
    if (\DB::getDoctrineSchemaManager()->tablesExist('options')) {
        if (!is_null(Option::get('vk-user-id')) && !is_null(Option::get('vk-group-id'))) {
            if (!is_null(Option::get('vk-board-topic-id'))) {
                Admin::menu(\App\Review::class)->label('Отзывы')->icon('fa-comments-o');
            }
        }
    }
});
Admin::menu()->url('history')->label('История')->icon('fa-history')->items(function() {
    Admin::menu(\App\HistoryDate::class)->label('Даты')->icon('fa-calendar');
    Admin::menu(\App\HistoryEvent::class)->label('События')->icon('fa-tasks');
});