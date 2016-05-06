<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {

    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var [type]
     */
    protected $dates = ['deleted_at', 'date', 'created_at', 'updated_at'];

    /**
     * @var [type]
     */
    protected $fillable = [
        'external_id',
        'date',
        'text',
        'attachments'
    ];

    /**
     * @var array
     */
    protected $guarded = ['id'];

    public function attachments() {
        return $this->belongsToMany('App\Attachment');
    }

}
