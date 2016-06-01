<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Review
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $date
 * @property string $text
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Profile $profile
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereDeletedAt($value)
 * @property string $external_id
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereExternalId($value)
 */
class Review extends Model {

    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'profile_id',
        'external_id',
        'date',
        'text'
    ];

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile() {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }
}
