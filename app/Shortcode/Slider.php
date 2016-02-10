<?php namespace App\Shortcode;


class Slider {
    public function register($attr, $content = null, $name = null) {
        $slides = \App\Slide::orderBy('sort')->get();
        $html = '';
        foreach($slides as $slide) {
            $html .= '<div class="slide" id="slide-'.$slide->id.'" style="background: url('.$slide->image->thumbnail('original').')">';
            $html .= '<h2>'.$slide->title.'</h2>';
            $html .= '<p class="lead">'.$slide->description.'</p>';
            $html .= '<p class="lead">'.link_to_route('page', 'Подробней', ['page' => $slide->page->slug], ['class' => 'btn btn-primary btn-lg']).'</p>';
            $html .= '</div>';
        }
        return $html;
    }
}