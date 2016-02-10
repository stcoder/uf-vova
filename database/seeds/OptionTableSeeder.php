<?php

class OptionTableSeeder extends DatabaseSeeder {
    public function run() {
        \App\Option::create([
            'name' => 'home_page',
            'title' => 'Главная страница',
            'value' => null,
            'other_opts' => '{"type": "select", "model": "\App\Page"}'
        ]);
    }
}