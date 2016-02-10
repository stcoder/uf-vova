<?php namespace App\FormItem;

use SleepingOwl\Admin\Models\Form\FormItem\BaseFormItem;
use SleepingOwl\Admin\Models\Form\FormItem\Select;
use SleepingOwl\Admin\Models\Form\FormItem\Textarea;

class OptionValue extends BaseFormItem {
    protected $select;
    protected $textarea;

    public function init($name, $label) {
        $this->name = $name;
        $this->label = $label;

        $this->select = new Select($name, $label);
        $this->textarea = new Textarea($name, $label);
    }

    public function render() {
        $instance = \Admin::instance()->formBuilder->getModel();
        $opts = $instance->opts();
        $type = 'textarea';
        if ($opts) {
            $type = $opts->type;
        }

        $render = '';
        switch($type) {
            case 'select':
                $this->select->list($opts->model);
                $render = $this->select->render();
                break;
            case 'textarea':
                $render = $this->textarea->render();
                break;
        }

        return $render;
    }
}