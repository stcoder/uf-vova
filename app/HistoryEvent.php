<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\HistoryEvent
 *
 * @property integer $id
 * @property integer $history_date_id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $date_event
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\HistoryDate $date
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryEvent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryEvent whereHistoryDateId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryEvent whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryEvent whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryEvent whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryEvent whereDateEvent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryEvent whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HistoryEvent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HistoryEvent extends Model {

    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function date() {
        return $this->belongsTo(HistoryDate::class, 'history_date_id', 'id');
    }

}
