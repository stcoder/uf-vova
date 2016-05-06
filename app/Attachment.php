<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model {

    use SoftDeletes;

    /**
     * @var [type]
     */
    protected $dates = ['deleted_at', 'date', 'created_at', 'updated_at'];

    /**
     * @var [type]
     */
    protected $fillable = [
        'external_id',
        'access_key',
        'type',
        'title',
        'description',
        'srcs'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts() {
        return $this->belongsToMany('App\Post');
    }

    public function childs() {
        return $this->belongsToMany('App\Attachment', 'attachment_from_attachment', 'parent_attachment_id', 'child_attachment_id');
    }

    /**
     * @param $value
     */
    public function setSrcsAttribute($value) {
        $this->attributes['srcs'] = json_encode($value);
    }

    /**
     * @return mixed
     */
    public function getSrcsAttribute() {
        return json_decode($this->attributes['srcs'], true);
    }

}
