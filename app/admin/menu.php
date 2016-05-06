<?php

use App\Option;

Admin::menu()->url('/')->label('Dashboard')->icon('fa-dashboard');
Admin::menu()->url('integration')->label('Интеграция')->icon('fa-angle-double-up')->items(function() {
    Admin::menu()->url('integration')->label('Подключение')->icon('fa-angle-double-up');
    if (\DB::getDoctrineSchemaManager()->tablesExist('options')) {
        if (!is_null(Option::get('vk-user-id')) && !is_null(Option::get('vk-group-id'))) {
            Admin::menu()->url('integration/imports')->label('Импорт')->icon('fa-cloud-download');
        }
    }
});
Admin::menu(\App\Page::class)->label('Страницы')->icon('fa-file-text');
Admin::menu(\App\Slide::class)->label('Слайды')->icon('fa-picture-o');
