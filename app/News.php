<?php namespace App;

use App\Models\Attributes\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class News extends Model implements SluggableInterface {

    use SluggableTrait;
    use SoftDeletes;

    protected $dates = ['published_at'];

    protected $guarded = ['*'];

    protected $fillable = [
        'title',
        'header_image',
        'published',
        'short_content',
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

    public function isPublished()
    {
        return $this->published;
    }

    public function setPublishedAttribute($published)
    {
        $this->attributes['published_at'] = $published ? $this->freshTimestamp() : null;
        $this->attributes['published'] = $published;
    }

    public function setHeaderImageAttribute($value)
    {
        if (
            is_null($value) || empty($value) || ($this->header_image && $value != $this->header_image->getPath())
        ) {
            $this->header_image->delete();
        }

        $result = '';

        if (!is_null($value) && !empty($value)) {
            $imageName = last(explode('/', $value));
            $targetDirectory = config('admin.imagesUploadDirectory') . '/news/' . $this->id;
            $toDirectory = public_path($targetDirectory);

            if (!\File::exists($toDirectory)) {
                \File::makeDirectory($toDirectory, 0755, true);
            }

            if (\File::exists(public_path($value))) {
                \File::move(public_path($value), $toDirectory . '/' . $imageName);
            }

            $result = $targetDirectory . '/' . $imageName;
        }

        $this->attributes['header_image'] = $result;
    }

    public function getHeaderImageAttribute($value)
    {
        $img = new Image($value, 'news', $this->id);
        if ($img->exists()) {
            return $img;
        } else {
            return null;
        }
    }

}
