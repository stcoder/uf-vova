<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Profile
 *
 * @property integer $id
 * @property integer $external_id
 * @property string $first_name
 * @property string $last_name
 * @property string $domain
 * @property string $photo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $reviews
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereExternalId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereDomain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile wherePhoto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereDeletedAt($value)
 * @property string $photo_big
 * @method static \Illuminate\Database\Query\Builder|\App\Profile wherePhotoBig($value)
 */
class Profile extends Model {

    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'external_id',
        'first_name',
        'last_name',
        'domain',
        'photo'
    ];

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews() {
        return $this->hasMany(Review::class, 'profile_id', 'id');
    }
}
