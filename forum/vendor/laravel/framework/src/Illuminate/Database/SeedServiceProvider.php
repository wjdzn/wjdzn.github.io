<<<<<<< HEAD
<?php namespace Illuminate\Database;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Console\SeedCommand;

class SeedServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerSeedCommand();

		$this->app->bindShared('seeder', function($app)
		{
			return new Seeder;
		});

		$this->commands('command.seed');
	}

	/**
	 * Register the seed console command.
	 *
	 * @return void
	 */
	protected function registerSeedCommand()
	{
		$this->app->bindShared('command.seed', function($app)
		{
			return new SeedCommand($app['db']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('seeder', 'command.seed');
	}

}
=======
<?php namespace Illuminate\Database;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Console\SeedCommand;

class SeedServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerSeedCommand();

		$this->app->bindShared('seeder', function($app)
		{
			return new Seeder;
		});

		$this->commands('command.seed');
	}

	/**
	 * Register the seed console command.
	 *
	 * @return void
	 */
	protected function registerSeedCommand()
	{
		$this->app->bindShared('command.seed', function($app)
		{
			return new SeedCommand($app['db']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('seeder', 'command.seed');
	}

}
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
