<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart\Cart;

class ShoppingcartServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['cart'] = $this->app->share(function($app)
		{
			$session = $app['session'];
			$events = $app['events'];
			return new Cart($session, $events);
		});
	}
}