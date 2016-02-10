<?php namespace App;

use SleepingOwl\Models\SleepingOwlModel as Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Page extends Model implements SluggableInterface {

	use SluggableTrait;

    protected $guarded = ['*'];

    protected $fillable = [
        'title',
        'published',
        'content',
        'slug',
        'admin_id',
        'meta_keywords',
        'meta_description',
        'meta_others'
    ];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug'
    ];

    public static function getList() {
        $lists = static::where('published', '=', 1)->get(['id', 'title']);
        return $lists->lists('title', 'id');
    }

    public function isPublished() {
        return $this->published;
    }
}
