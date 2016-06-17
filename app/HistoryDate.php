<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SleepingOwl\Admin\Traits\OrderableModel;

/**
 * App\HistoryDate
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HistoryEvent[] $events
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryDate whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryDate whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryDate whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryDate whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryDate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HistoryDate extends Model {

    use SoftDeletes;

    use OrderableModel;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events() {
        return $this->hasMany(HistoryEvent::class);
    }

    /**
     * @return string
     */
    public function getOrderField() {
        return 'order';
    }

}
