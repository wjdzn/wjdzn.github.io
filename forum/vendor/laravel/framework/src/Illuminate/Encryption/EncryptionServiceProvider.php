<<<<<<< HEAD
<?php namespace Illuminate\Encryption;

use Illuminate\Support\ServiceProvider;

class EncryptionServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bindShared('encrypter', function($app)
		{
			$encrypter =  new Encrypter($app['config']['app.key']);

			if ($app['config']->has('app.cipher'))
			{
				$encrypter->setCipher($app['config']['app.cipher']);
			}

			return $encrypter;
		});
	}

}
=======
<?php namespace Illuminate\Encryption;

use Illuminate\Support\ServiceProvider;

class EncryptionServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bindShared('encrypter', function($app)
		{
			$encrypter =  new Encrypter($app['config']['app.key']);

			if ($app['config']->has('app.cipher'))
			{
				$encrypter->setCipher($app['config']['app.cipher']);
			}

			return $encrypter;
		});
	}

}
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
