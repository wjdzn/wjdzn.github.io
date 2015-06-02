<<<<<<< HEAD
<?php namespace Illuminate\Support\Facades;

/**
 * @see \Illuminate\Cookie\CookieJar
 */
class Cookie extends Facade {

	/**
	 * Determine if a cookie exists on the request.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public static function has($key)
	{
		return ! is_null(static::$app['request']->cookie($key, null));
	}

	/**
	 * Retrieve a cookie from the request.
	 *
	 * @param  string  $key
	 * @param  mixed   $default
	 * @return string
	 */
	public static function get($key = null, $default = null)
	{
		return static::$app['request']->cookie($key, $default);
	}

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'cookie'; }

}
=======
<?php namespace Illuminate\Support\Facades;

/**
 * @see \Illuminate\Cookie\CookieJar
 */
class Cookie extends Facade {

	/**
	 * Determine if a cookie exists on the request.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public static function has($key)
	{
		return ! is_null(static::$app['request']->cookie($key, null));
	}

	/**
	 * Retrieve a cookie from the request.
	 *
	 * @param  string  $key
	 * @param  mixed   $default
	 * @return string
	 */
	public static function get($key = null, $default = null)
	{
		return static::$app['request']->cookie($key, $default);
	}

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'cookie'; }

}
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
