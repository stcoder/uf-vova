<?php namespace App;

use SleepingOwl\Models\SleepingOwlModel as Model;
use SleepingOwl\Models\Interfaces\ModelWithOrderFieldInterface;
use SleepingOwl\Models\Traits\ModelWithImageOrFileFieldsTrait;
use SleepingOwl\Models\Traits\ModelWithOrderFieldTrait;
use SleepingOwl\Models\Interfaces\ModelWithImageFieldsInterface;

class Slide extends Model implements ModelWithImageFieldsInterface, ModelWithOrderFieldInterface {

    use ModelWithOrderFieldTrait;
    use ModelWithImageOrFileFieldsTrait;

    protected $guarded = ['*'];

    protected $fillable = ['title', 'description', 'page_id', 'image', 'sort'];

	public function page() {
        return $this->hasOne('\App\Page', 'id', 'page_id');
    }

    public function getImageFields() {
        return [
            'image' => 'slides/'
        ];
    }
}
