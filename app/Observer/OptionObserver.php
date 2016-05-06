<?php namespace App\Observer;

use Cache;

class OptionObserver {
    public function saved($model) {
        Cache::forever('option-' . $model->name, $model->value);
    }
}