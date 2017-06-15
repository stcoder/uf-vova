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
            'url' => $this->_getUrl(),
            'published_at' => $value ? $this->instance->published_at->formatLocalized('%d %B %Y в %H:%M') : null
        ];
        return view('admin.column.published', $params);
    }

    protected function _getUrl() {
        if ($this->instance instanceof \App\Page) {
            return route('page', ['slug' => $this->instance->slug]);
        } elseif ($this->instance instanceof \App\News) {
            return route('news', ['date' => $this->instance->published_at->formatLocalized('%Y-%m-%d'), 'slug' => $this->instance->slug]);
        }
    }
}