<?php namespace App;

use SleepingOwl\Models\SleepingOwlModel as Model;

class Option extends Model {

	public $timestamps = false;

	protected $guarded = ['*'];

	protected $fillable = ['name', 'title', 'value', 'other_opts'];

	protected $_opts = null;

	public function opts() {
		if (!$this->_opts) {
			$opts = json_decode($this->other_opts);
			if ($opts) {
				if (isset($opts->model)) {
					$opts->model = str_replace('/', '\\', $opts->model);
				}
			}

			$this->_opts = $opts;
		}

		return $this->_opts;
	}

}
