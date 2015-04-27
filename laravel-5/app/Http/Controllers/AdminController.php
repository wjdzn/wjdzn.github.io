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
        $eventsLikeThisByName = CalendarEvent::where('name','=',$event->name)->where('all_day','=','1')->get();
        $init_date = strtotime($event->end_at);
        $date = new DateTime($init_date);
        $date->modify('+1 day');
        if(count($eventsLikeThisByName)>0)
        {
            foreach($eventsLikeThisByName as $ev)
            {
                $date_end = strtotime($ev->end_at);
                if($date>=$date_end)
                {
                    $ev->end_at = $event->end_at;
                    $ev->save();
                    return 2;
                }
            }
        }
        $event->save();
        return 1;
    }

    /**
     * Get all events from DB and return it in json format.
     *
     * @return Response
     */
    public function events()
    {
        $events = CalendarEvent::all();
        $result = array();
        $count=0;
        foreach($events as $ev)
        {
            $result[$count]['title']=$ev->name;
            $result[$count]['start']=$ev->init_at;
            $result[$count]['end']=$ev->end_at;
            $result[$count]['backgroundColor']=$ev->backgroundcolor;
            $count++;
        }
        echo  json_encode($result);
    }
}
