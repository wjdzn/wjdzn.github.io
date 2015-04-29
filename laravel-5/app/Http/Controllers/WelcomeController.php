<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Auth\Guard as Auth;
use Illuminate\Http\RedirectResponse;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/
    /**
     * The Guard implementation.
     *
     * @var Authenticator
     */
    protected $auth;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Auth $auth)
	{
		//$this->middleware('guest');
        $this->auth = $auth;
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

    public function calendar()
    {
        return view('calendar');
    }
    public function login_for_forum()
    {
        $credentials = Input::all();
        if($this->auth->once($credentials));
            return new RedirectResponse(url('/home'));
        return redirect()->guest('auth/login');
    }

}
