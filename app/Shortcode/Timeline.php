<?php namespace App\Shortcode;


class Timeline {
    public function register($attr, $content = null, $name = null) {
        return view('shortcode.timeline', [])->render();
    }
}