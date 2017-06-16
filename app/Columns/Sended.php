<?php namespace App\Columns;

use SleepingOwl\Admin\Columns\Column\NamedColumn;

class Sended extends NamedColumn
{

    /**
     * @return View
     */
    public function render()
    {
        $value = $this->getValue($this->instance, $this->name());
        $params = [
            'class' => $value ? 'success' : 'danger',
            'label' => $value ? 'Да' : 'Нет',
            'sended' => $value,
            'send_date' => $value ? $this->instance->send_date->formatLocalized('%d %B %Y в %H:%M') : null
        ];
        return view('admin.column.sended', $params);
    }
}