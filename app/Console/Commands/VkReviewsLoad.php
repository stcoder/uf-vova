<?php namespace App\Console\Commands;

use App\Imports\Review;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class VkReviewsLoad extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'vk:load_reviews';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Загрузить отзывы.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$offset = $this->argument('offset') ?: 0;
		$count = $this->argument('count') ?: 100;

		$this->info('Начинаю загрузку отзывов.' . date('d.m.Y H:i'));
		$res = Review::import($offset, $count);
		$this->info('Загрузка завершена.');
		$this->comment('Всего записей: ' . $res['counts']['all']);
		$this->comment('Запрос: offset -> ' . $offset . '; count -> ' . $count);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['offset', InputArgument::OPTIONAL, 'Offset.'],
			['count', InputArgument::OPTIONAL, 'Count.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
