<<<<<<< HEAD
<?php namespace Illuminate\Cookie;

use Illuminate\Support\ServiceProvider;

class CookieServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bindShared('cookie', function($app)
		{
			$config = $app['config']['session'];

			return (new CookieJar)->setDefaultPathAndDomain($config['path'], $config['domain']);
		});
	}
}
=======
<?php namespace Illuminate\Cookie;

use Illuminate\Support\ServiceProvider;

class CookieServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bindShared('cookie', function($app)
		{
			$config = $app['config']['session'];

			return (new CookieJar)->setDefaultPathAndDomain($config['path'], $config['domain']);
		});
	}
}
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
