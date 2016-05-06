<?php namespace App\Shortcode;

class Section {
    public function register($attr, $content = null, $name = null) {
        $content = \Shortcode::compile($content);
        $attr['class'] = 'section ' . str_replace('&quot;', '', isset($attr['class']) ? $attr['class'] : '');
        $hr = isset($attr['hr']) ? $attr['hr'] : null;
        if ($hr) {
            unset($attr['hr']);
            $content .= '<hr class="half-rule">';
        }
        return '<div '.\Html::attributes($attr).'>' . $content . '</div>';
    }
}
