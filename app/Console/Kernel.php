<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
		'App\Console\Commands\VkReviewsLoad',
		'App\Console\Commands\FeedbackSender',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$file = app_path() . '/../feedbacks.out';
		$schedule->command('feedback:sender')
      ->everyFiveMinutes()
			->sendOutputTo($file);

		$file = app_path() . '/../review.out';
		$schedule->command('vk:load_reviews')
			->hourly()
			->sendOutputTo($file);
	}

}
