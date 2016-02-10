<?php namespace App\Columns;

use SleepingOwl\Admin\Columns\Column\BaseColumn;

class Published extends BaseColumn {
    public function render($instance, $totalCount) {
        $html = '<span class="label label-%s">%s</span>';
        $content = ($instance->{$this->name}) ? sprintf($html, 'success', 'Да') : sprintf($html, 'danger', 'Нет');
        return parent::render($instance, $totalCount, $content);
    }
}