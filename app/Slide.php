<?php namespace App;

use App\Models\Attributes\Image;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * App\Slide
 *
 * @property integer $id
 * @property integer $page_id
 * @property string $title
 * @property string $description
 * @property Image $image
 * @property integer $sort
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Page $page
 * @method static \Illuminate\Database\Query\Builder|\App\Slide orderModel()
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide wherePageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Slide extends Model
{

    use OrderableModel;
    protected $guarded = ['*'];

    protected $fillable = ['title', 'description', 'page_id', 'image', 'sort'];

	public function page()
    {
        return $this->hasOne('\App\Page', 'id', 'page_id');
    }

    public function getOrderField()
    {
        return 'sort';
    }

    public function setImageAttribute($value)
    {
        $this->image->delete();

        if (!is_null($value)) {
            $imageName = last(explode('/', $value));
            $targetDirectory = config('admin.imagesUploadDirectory') . '/slides';
            $toDirectory = public_path($targetDirectory);

            if (!\File::exists($toDirectory)) {
                \File::makeDirectory($toDirectory);
            }

            if (\File::exists($value)) {
                \File::move(public_path($value), $toDirectory . '/' . $imageName);
            }

            $this->attributes['image'] = $targetDirectory . '/' . $imageName;
        }
    }

    public function getImageAttribute($value)
    {
        return $value ? new Image($value) : null;
    }
}
