<?php

/** @var \SleepingOwl\Admin\Model\ModelConfiguration $model */
$model = Admin::model(\App\HistoryEvent::class);
$model->title('История – события');

$model->display(function() {
    $display = AdminDisplay::datatables();
    $display->with('date');
    $display->columns([
        Column::checkbox(),
        Column::string('date.title')->label('Дата'),
        Column::custom()->label('Заголовок')->callback(function($instance) {
            $res = $instance->title;
            if ($instance->more) {
                $res .= '<br><div class="label label-primary">Кнопка – подробней</div>';
            }
            return $res;
        }),
        Column::datetime('date_event')->format('d.m.Y')->label('Точная дата события'),
        Column::datetime('created_at')->label('Создан')->format('d.m.Y в H:i'),
    ]);
    $display->apply(function(\Illuminate\Database\Eloquent\Builder $query) {
        $query->withTrashed();
    });
    return $display;
})->createAndEdit(function($id) use($model) {
    $model->title($id ? 'Редактировать событие' : 'Создать событие');
    $form = AdminForm::form();
    $form->items([
        FormItem::text('title', 'Заголовок'),
        FormItem::image('image', 'Картинка'),
        FormItem::select('history_date_id', 'Дата')->model(\App\HistoryDate::class)->display('title')->required(),
        FormItem::ckeditor('description', 'Описание')->required(),
        FormItem::date('date_event', 'Точная дата события'),
        FormItem::checkbox('more', 'Показать кнопку – подробней'),
    ]);

    return $form;
});