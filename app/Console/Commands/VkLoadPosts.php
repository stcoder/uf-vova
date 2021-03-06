<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class VkLoadPosts extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'vk:load_posts';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Загружает посты из группы ВК.';

	/**
	 * Идентификатор группы Vk.
	 *
	 * @var string
	 */
	protected $ownerId = null;

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
	 * Execute the console.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$offset = $this->argument('offset') ?: 0;
		$count = $this->argument('count') ?: 10;

		$this->info('Начинаю загрузку постов. ' . date('d.m.Y H:i'));
		$res = \App\Imports\Post::import($offset, $count);
		$this->info('Загрузка завершена.');
		$this->comment('Запрос: offset -> ' . $offset . '; count -> ' . $count);
		$this->comment('Всего записей: ' . $res['counts']['all']);
		$this->comment('Постов: ' . $res['counts']['posts']);
		$this->comment('Новых постов: ' . $res['counts']['new_posts']);
		$this->comment('Вложений: ' . $res['counts']['attachments']);
		$this->comment('Новых вложений: ' . $res['counts']['new_attachments']);
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
