<<<<<<< HEAD
<?php namespace Illuminate\Routing\Matching;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class HostValidator implements ValidatorInterface {

	/**
	 * Validate a given rule against a route and request.
	 *
	 * @param  \Illuminate\Routing\Route  $route
	 * @param  \Illuminate\Http\Request  $request
	 * @return bool
	 */
	public function matches(Route $route, Request $request)
	{
		if (is_null($route->getCompiled()->getHostRegex())) return true;

		return preg_match($route->getCompiled()->getHostRegex(), $request->getHost());
	}

}
=======
<?php namespace Illuminate\Routing\Matching;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class HostValidator implements ValidatorInterface {

	/**
	 * Validate a given rule against a route and request.
	 *
	 * @param  \Illuminate\Routing\Route  $route
	 * @param  \Illuminate\Http\Request  $request
	 * @return bool
	 */
	public function matches(Route $route, Request $request)
	{
		if (is_null($route->getCompiled()->getHostRegex())) return true;

		return preg_match($route->getCompiled()->getHostRegex(), $request->getHost());
	}

}
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
