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
<<<<<<< HEAD
}
=======
}
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
