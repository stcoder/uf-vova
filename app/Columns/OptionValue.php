<?php namespace App\Columns;

use SleepingOwl\Admin\Columns\Column\BaseColumn;
use SleepingOwl\Admin\Columns\Column\Filter;

class OptionValue extends BaseColumn {
    public function render($instance, $totalCount) {
        $content = '';
        $opts = $instance->opts();
        $type = 'textarea';
        $render = null;
        if ($opts) {
            $type = $opts->type;
        }

        switch($type) {
            case 'select':
                $model = $opts->model;
                $item = $model::find($instance->value);
                $content = $item->title;

                \ModelItem::$current = $this->modelItem;
                $filter = new Filter('id');
                $filter->value('value');
                $filter->model($opts->model);
                $this->append($filter);
                $render = parent::render($instance, $totalCount, $content);
                $this->appends = [];
                break;
            case 'textarea':
                $content = e($instance->value);
                break;
        }
        if (!$render) {
            $render = parent::render($instance, $totalCount, $content);
        }
        return $render;
    }
}