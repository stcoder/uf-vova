<?php namespace App\Shortcode;

class Iframe {
    public function register($attr, $content = null, $name = null) {
        $attr = array_map(function($value) {
            return str_replace('&quot;', '', $value);
        }, $attr);
        return '<iframe '.\Html::attributes($attr).'></iframe>';
    }
}