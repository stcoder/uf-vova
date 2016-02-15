<?php namespace App\Columns;

use SleepingOwl\Admin\Columns\Column\NamedColumn;

class Published extends NamedColumn
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
            'publishedable' => $value,
            'url' => route('page', ['page' => $this->instance->slug]),
            'published_at' => $value ? $this->instance->published_at : null
        ];
        return view('admin.column.published', $params);
    }
}