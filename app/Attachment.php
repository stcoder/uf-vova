<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Attachment
 *
 * @property integer $id
 * @property string $external_id
 * @property string $access_key
 * @property string $type
 * @property string $title
 * @property string $description
 * @property string $srcs
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attachment[] $childs
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereExternalId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereAccessKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereSrcs($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    /**
     * @return Attachment[]|\Illuminate\Database\Eloquent\Collection|null
     */
    public function getPhotosByAlbum() {
        $photos = null;

        if ($this->type === 'album') {
            $photos = $this->childs;
        }

        return $photos;
    }

}
