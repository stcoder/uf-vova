<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

/**
 * App\Option
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $value
 * @property string $other_opts
 */
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

	/**
	 * Записывает значение для опции.
	 * Создает новую опцию если ее нет.
	 *
	 * @param string $key
	 * @param string|integer|boolean|null|float $value
	 * @return $this
	 */
	public static function set($key, $value) {
		$option = null;
		if (self::has($key)) {
			$option = self::where('name', '=', $key)->first();
		} else {
			$option = new self();
			$option->name = $key;
		}
		$option->value = $value;
		$option->save();
	}

	/**
	 * Возвращает значение опции.
	 *
	 * @param string $key
	 * @param null $default
	 * @return string|integer|boolean|null|float
	 */
	public static function get($key, $default = null) {
		$value = null;
		if (self::has($key)) {
			$value = Cache::get('option-' . $key);
		} else {
			$option = self::where('name', '=', $key)->first();
			$value = is_null($option) ? $default : $option->value;
		}

		return $value;
	}

	/**
	 * Проверяет опцию на существование.
	 *
	 * @param string $key
	 * @return boolean
	 */
	public static function has($key) {
		$return = false;
		if (Cache::has('option-' . $key)) {
			$return = true;
		} else {
			$model = self::where('name', '=', $key)->first();

			if ($model) {
				Cache::forever('option-'.$key, $model->value);
				$return = !!$model;
			}
		}
		
		return $return;
	}
}
