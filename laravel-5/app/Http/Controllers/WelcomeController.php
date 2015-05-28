<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Auth\Guard as Auth;
use Illuminate\Http\RedirectResponse;
use App\User;
use App\Models\CalendarEvent;

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
    public function events()
    {
        $events = CalendarEvent::all();
        $result = array();
        $count=0;
        foreach($events as $ev)
        {
            $result[$count]['id']=$ev->id;
            $result[$count]['title']=$ev->name;
            $result[$count]['start']=$ev->init_at;
            $result[$count]['end']=$ev->end_at;
            $result[$count]['allDay']=$ev->all_day;
            $result[$count]['forceEventDuration']=true;
            $result[$count]['backgroundColor']=$ev->backgroundcolor;
            $count++;
        }
        echo  json_encode($result);
    }
    public function update_from_forum()
    {
        $user = User::where('email','LIKE',Input::get('email'))->first();
        $user->password = bcrypt($user->password_text);
        $user->password_text=null;
        $user->attachRole(2);
        $user->save();
    }
    public function login_forum()
    {
        $usr = Input::get('email');
        if($usr == ""){
            return redirect()->guest('/');
        }
        $user = User::where('email','LIKE',Input::get('email'))->first();
        if($this->auth->login($user))
            return redirect()->guest('/');
        return redirect()->guest('main');
    }

}
