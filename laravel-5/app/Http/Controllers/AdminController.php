<?php namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Models\UserForum;
use PhpSpec\Exception\Exception;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\RedirectResponse;

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

     * Show the application dashboard to the user.
     *
     * @return Response
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
        $date_init=new \DateTime(date('Y:m:d h:i:s',strtotime(Input::get('init_at'))));
        $date_end =new \DateTime(date('Y:m:d h:i:s',strtotime(Input::get('end_at'))));
        $event->init_at = $date_init;
        $event->end_at = $date_end;
        $eventsLikeThisByName = CalendarEvent::where('name',$event->name)->where('all_day','1')->get();
        if(count($eventsLikeThisByName)>0)
        {
            foreach($eventsLikeThisByName as $ev)
            {
                $date_end_ev =new \DateTime(date('Y:m:d h:i:s',strtotime($ev->end_at)));
                if($ev->all_day && $date_init->diff($date_end_ev)->days<=1 && $date_init>=$date_end_ev)
                {
                    $ev->end_at = $event->end_at;
                    $ev->save();
                    return $ev->id;
                }
            }
        }
        $event->save();
        return $event->id;
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

    /**
     * Update an event(right now only start and end date and all_day) from id
     *
     * @return Response
     */
    public function update_event()
    {
        $current_event = CalendarEvent::find(Input::get('id'));
        $date_init=new \DateTime(date('Y:m:d h:i:s',strtotime(Input::get('init_at'))));
        $date_end =new \DateTime(date('Y:m:d h:i:s',strtotime(Input::get('end_at'))));
        $current_event->init_at = $date_init;
        $current_event->end_at = $date_end;
        $current_event->all_day = Input::get('all_day');
        $current_event->save();
        return 1;
    }
    /**
     * Delete an event from id
     *
     * @return Response
     */
    public function delete_event()
    {
        $current_event = CalendarEvent::find(Input::get('id'));
        $current_event->delete();
        return 1;
    }
    /**
     * Show a users list to the user.
     *
     * @return Response
     */
    public function users()
    {
        $users = User::role('subscriber')->get();
        return view('admin.users.index',array('users' => $users));
    }
    public function update_user($email = null)
    {
        try{
            // Get the user information
            $user = UserForum::where('email',$email)->first();
            $user_local = User::where('email',$email)->first();
             // Get a list of all the available groups
            $roles = Role::all();
            if(!isset($user))
            {
                $error = Lang::get('users/message.user_not_found', compact('id'));

                // Redirect to the user management page
                return redirect()->guest('admin/users')->with('error', $error);
            }
        }
        catch (Exception $e)
        {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return redirect()->guest('admin/users')->with('error', $error);
        }
        // Show the page
        return View('admin.users.edit', array('user'=>$user,'roles'=>$roles,'user_local'=>$user_local));
    }
    public function post_update_user($id = null)
    {
        try
        {
            // Get the user information
            $user = Sentry::getUserProvider()->findById($id);
        }
        catch (UserNotFoundException $e)
        {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('users')->with('error', $error);
        }

        //
        $this->validationRules['email'] = "required|email|unique:users,email,{$user->email},email";

        // Do we want to update the user password?
        if ( ! $password = Input::get('password'))
        {
            unset($this->validationRules['password']);
            unset($this->validationRules['password_confirm']);
        }

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $this->validationRules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        try {
            // Update the user
            $user->first_name  = Input::get('first_name');
            $user->last_name   = Input::get('last_name');
            $user->email       = Input::get('email');
            $user->dob   = Input::get('dob');
            $user->bio   = Input::get('bio');
            $user->gender   = Input::get('gender');
            $user->country   = Input::get('country');
            $user->state   = Input::get('state');
            $user->city   = Input::get('city');
            $user->address   = Input::get('address');
            $user->postal   = Input::get('postal');
            $user->activated   = Input::get('activate')?1:0;

            // Do we want to update the user password?
            if ($password) {
                $user->password = $password;
            }

            // is new image uploaded?
            if ($file = Input::file('pic'))
            {
                $fileName        = $file->getClientOriginalName();
                $extension       = $file->getClientOriginalExtension() ?: 'png';
                $folderName      = '/uploads/users/';
                $destinationPath = public_path() . $folderName;
                $safeName        = str_random(10).'.'.$extension;
                $file->move($destinationPath, $safeName);

                //delete old pic if exists
                if(File::exists(public_path() . $folderName.$user->pic))
                {
                    File::delete(public_path() . $folderName.$user->pic);
                }

                //save new file path into db
                $user->pic   = $safeName;

            }

            // Get the current user groups
            $userGroups = $user->groups()->lists('group_id', 'group_id');

            // Get the selected groups
            $selectedGroups = Input::get('groups', array());

            // Groups comparison between the groups the user currently
            // have and the groups the user wish to have.
            $groupsToAdd    = array_diff($selectedGroups, $userGroups);
            $groupsToRemove = array_diff($userGroups, $selectedGroups);

            // Assign the user to groups
            foreach ($groupsToAdd as $groupId) {
                $group = Sentry::getGroupProvider()->findById($groupId);

                $user->addGroup($group);
            }

            // Remove the user from groups
            foreach ($groupsToRemove as $groupId) {
                $group = Sentry::getGroupProvider()->findById($groupId);

                $user->removeGroup($group);
            }

            // Was the user updated?
            if ($user->save()) {
                // Prepare the success message
                $success = Lang::get('users/message.success.update');

                // Redirect to the user page
                return redirect()->guest('users.update', $id)->with('success', $success);
            }

            // Prepare the error message
            $error = Lang::get('users/message.error.update');
        } catch (LoginRequiredException $e) {
            $error = Lang::get('users/message.user_login_required');
        }

        // Redirect to the user page
        return redirect()->guest('users.update', $id)->withInput()->with('error', $error);
    }
    public function delete_user($email = null)
    {
        $user_forum = UserForum::where('email',$email)->first();
        $user_local = User::where('email',$email)->first();
        $user_forum->delete();
        $user_local->delete();
    }

}
