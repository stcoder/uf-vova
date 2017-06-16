<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\Feedback;

class FeedbackSender extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'feedback:sender';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Отправляет заявки обратной связи на почту.';

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
		$this->info('Начинаю сбор заявок - ' . date('d.m.Y H:i'));
		$orders = Feedback::where('sended', false)->orderBy('created_at')->get();

		if ($orders->count() <= 0) {
			$this->info('Заявок нет.');
			return;
		}

		$this->comment('Всего заявок для отправки: ' . $orders->count());

		\Mail::send('emails.feedbacks', ['orders' => $orders], function($message)
		{
		    $message->to(config('mail.feedback_send_to'))->subject('Заявки на обратный звонок');
		});

		foreach($orders as $order) {
			$order->sended = true;
			$order->send_date = new \DateTime();
			$order->save();
		}

		$this->info('Все заявки отправлены.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}

}
