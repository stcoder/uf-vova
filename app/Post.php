<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Post
 *
 * @property integer $id
 * @property string $external_id
 * @property \Carbon\Carbon $date
 * @property string $text
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attachment[] $attachments
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereExternalId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attachments() {
        return $this->belongsToMany('App\Attachment');
    }

    /**
     * @return null|string
     */
    public function getFirstImage() {
        $where = $this->attachments()->whereIn('type', ['photo', 'video', 'link', 'album']);
        $attachment = $where->first();

        if (is_null($attachment)) {
            return null;
        }

        switch($attachment->type) {
            case 'album':
                $attachment = $attachment->childs->first();
                break;
        }

        return $attachment->srcs['image_big'];
    }

}
