<?php

Admin::menu()->url('/')->label('Dashboard')->icon('fa-dashboard');
Admin::menu(\App\Page::class)->label('Страницы')->icon('fa-file-text');
Admin::menu(\App\Slide::class)->label('Слайды')->icon('fa-picture-o');
