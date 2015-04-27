<?php namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the calendar to the user.
     *
     * @return Response
     */
    public function calendar()
    {
        return view('admin.calendar');
    }

    /**
     * Save an event in DB.
     *
     * @return Response
     */
    public function save_event()
    {
        $event = new CalendarEvent(Input::all());
        $event->save();
    }

    /**
     * Get all events from DB and return it in json format.
     *
     * @return Response
     */
    public function events()
    {
        $events = CalendarEvent::all();
        $result = "[";
        $count=0;
        foreach($events as $ev)
        {
            $result.=$count>0?",":"";
            $result.="{title:'".$ev->name."',start:'".$ev->init_at."',end:'".$ev->end_at."',backgroundColor:'".$ev->backgroundcolor."'}";
            $count++;
        }
        $result.= "]";
        echo json_encode($result);
    }
}
