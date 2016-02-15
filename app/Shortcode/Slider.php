<?php namespace App\Shortcode;


class Slider {
    public function register($attr, $content = null, $name = null) {
        $slides = \App\Slide::orderBy('sort')->get();
        $html = '';
        foreach($slides as $slide) {
            $html .= view('shortcode.slide', ['slide' => $slide])->render();
        }
        return $html;
    }
}