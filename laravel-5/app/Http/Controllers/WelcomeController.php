<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Auth\Guard as Auth;
use Illuminate\Http\RedirectResponse;
use App\User;

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
    public function update_from_forum()
    {
        $user = User::where('email','LIKE',Input::get('email'))->first();
        $user->password = bcrypt($user->password_text);
        $user->password_text=null;
        $user->attachRole(2);
        $user->save();
        DB::update("update users set created_at = updated_at  WHERE email LIKE '".Input::get('email')."'");
    }
    public function login_forum()
    {
        $user = User::where('email','LIKE',Input::get('email'))->first();
        if($this->auth->login($user))
            return redirect()->guest('/');
        return redirect()->guest('auth/login');
    }

}
