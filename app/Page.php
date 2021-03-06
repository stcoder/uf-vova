<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
 * App\Page
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $meta_others
 * @property boolean $published
 * @property string $published_at
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereSlug($slug)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereMetaKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereMetaDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereMetaOthers($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page wherePublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Page extends Model implements SluggableInterface
{

	use SluggableTrait;
    use SoftDeletes;

    protected $guarded = ['*'];

    protected $dates = ['published_at'];

    protected $fillable = [
        'title',
        'published',
        'content',
        'slug',
        'meta_keywords',
        'meta_description',
        'meta_others'
    ];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug'
    ];

    public static function getList()
    {
        $lists = static::where('published', '=', 1)->get(['id', 'title']);
        return $lists->lists('title', 'id');
    }

    public function isPublished()
    {
        return $this->published;
    }

    public function setPublishedAttribute($published)
    {
        $this->attributes['published_at'] = $published ? $this->freshTimestamp() : null;
        $this->attributes['published'] = $published;
    }
}
