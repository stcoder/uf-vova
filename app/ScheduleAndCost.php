<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SleepingOwl\Admin\Traits\OrderableModel;

class ScheduleAndCost extends Model {

	use SoftDeletes;

    use OrderableModel;

}
