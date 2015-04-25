<?php namespace App\Http\Middleware;

use Closure;
use App\User;

class Administrator {

	/**
	 * The User implementation.
	 *
	 * @var User
	 */
	protected $user;

	/**
	 * Create a new filter instance.
	 *
	 * @param  User  $auth
	 * @return void
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if($this->user->is('admin'))
		    return $next($request);
        else
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                return redirect()->guest('auth/login');
            }
        }
	}

}
