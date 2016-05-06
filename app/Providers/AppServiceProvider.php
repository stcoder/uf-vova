<?php namespace App\Providers;

use App\Integration\Services\Vk;
use App\Observer\OptionObserver;
use App\Option;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use PhpSpec\Exception\Exception;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		setlocale(LC_ALL, 'ru_RU');
		Carbon::setLocale(config('app.locale'));
		\Shortcode::register('slider', '\App\Shortcode\Slider');
		\Shortcode::register('section', '\App\Shortcode\Section');
		\Shortcode::register('iframe', '\App\Shortcode\Iframe');
		\Shortcode::register('timeline', '\App\Shortcode\Timeline');

		if (\DB::getDoctrineSchemaManager()->tablesExist('options')) {
			Option::observe(new OptionObserver());


			if (Option::has('vk-user-token')) {
				Vk::setAccessToken(Option::get('vk-user-token'));
			}
		}
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
