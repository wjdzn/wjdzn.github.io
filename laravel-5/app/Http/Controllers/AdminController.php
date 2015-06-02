<?php namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Models\UserForum;
use App\Models\Product;
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
    public function update_user($id = null)
    {
        try{
            // Get the user information
            $user_local =User::find($id);
            $user =UserForum::where('email',$user_local->email)->first();
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
        $forum_user = UserForum::find($id);
        $user_local = User::where('email',$forum_user->email)->first();
        $password_new = Input::get('password');
        $password_new_re = Input::get('password_confirm');
        if(strlen($password_new)>0 && $password_new_re==$password_new)
        {
            $user_local->password = bcrypt($password_new);
            $user_local->save();
            $forum_user->password =  md5(e(Input::get('password')) . "forumiumpro");
            $forum_user->save();
        }
        $user_local->first_name =  Input::get('first_name');
        $forum_user->first_name = Input::get('first_name');
        $forum_user->surname = Input::get('last_name');
        $user_local->email =  Input::get('email');
        $forum_user->email =  Input::get('email');
        if(!$user_local->is(Input::get('rol')))
        {
            $rol = Role::where('slug',Input::get('rol'))->first();
            $user_local->changeRole($rol);
        }
        $user_local->save();
        $forum_user->save();
        $users = User::role('subscriber')->get();
        return redirect()->guest('admin/users')->with(array('users'=>$users,"success"=>"ok"));
        //return view('admin.users.index',array('users' => $users));
    }
    /**
     * Delete Confirm
     *
     * @param   int   $id
     * @return  View
     */
    public function getModalDeleteUser($email = null)
    {
        $confirm_route = route('user_delete',['email' => $email]);
        return View('admin.layouts.modal_confirmation', array("model"=>"users","confirm_route"=>$confirm_route,"email"=>$email));
    }
    public function delete_user($email = null)
    {
        $user_forum = UserForum::where('email',$email)->first();
        $user_local = User::where('email',$email)->first();
        if($user_forum)
            $user_forum->delete();
        if($user_forum)
            $user_local->delete();
        $success = Lang::get('users/message.success.delete');
        return redirect()->guest('admin/users')->with('success', $success);
    }
    public function show_user($id = null)
    {
        $user_local = User::find($id);
        $forum_user = UserForum::where('email',$user_local->email)->first();
        return View('admin.users.show', array("user_forum"=>$forum_user,"user_local"=>$user_local));
    }
    public function change_password_user($id = null)
    {
        $user_local = User::find($id);
        $forum_user = UserForum::where('email',$user_local->email)->first();
        $password_new = Input::get('password');
        $password_new_re = Input::get('password_re');
        if($password_new==$password_new_re)
        {
            $user_local->password = bcrypt($password_new);
            $user_local->save();
            $forum_user->password =  md5(e(Input::get('password')) . "forumiumpro");
            $forum_user->save();
        }
        return View('admin.users.show', array("user_forum"=>$forum_user,"user_local"=>$user_local));
    }
    public function products()
    {
        $products = Product::all();
        return view('admin.products.index',array('products' => $products));
    }
    public function new_product()
    {
        return view('admin.products.create');
    }
    public function save_product()
    {
        $product_new = new Product(Input::all());
        $file = Input::file('file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path().'/uploads', $fileName);
<<<<<<< HEAD
        $product_new->image = "/uploads/".$fileName;"/uploads/".$fileName;
=======
        $product_new->image = "/uploads/".$fileName;
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
        $product_new->save();
        $products = Product::all();
        return view('admin.products.index',array('products' => $products));
    }
    public function getModalDeleteProduct($id = null)
    {
        $confirm_route = route('product_delete',['id' => $id]);
        return View('admin.layouts.modal_confirmation', array("model"=>"products","confirm_route"=>$confirm_route,"id"=>$id));
    }
    public function delete_product($id = null)
    {
        $product = Product::find($id);
        $product->delete();
        $products = Product::all();
        return view('admin.products.index',array('products' => $products));
    }
    public function show_product($id = null)
    {
        $product = Product::find($id);
        return view('admin.products.show',array('product'=>$product));
    }
    public function update_product($id = null)
    {
        $product = Product::find($id);
        return view('admin.products.edit',array('product'=>$product));
    }
    public function post_update_product($id = null)
    {
        $product = Product::find($id);
        $file = Input::file('file');
        if(isset($file))
        {
            $fileName = $file->getClientOriginalName();
            $file->move(public_path().'/uploads', $fileName);
            $product->image = "/uploads/".$fileName;
        }
        $product->name = Input::get('name');
        $product->description = Input::get('description');
        $product->price = Input::get('price');
        $product->stock_amount = Input::get('stock_amount');
        $product->tax_value = Input::get('tax_value');
        $product->valid_at = Input::get('valid_at');
        $product->link = Input::get('link');
        $product->save();
        $products = Product::all();
        return view('admin.products.index',array('products' => $products));
    }

}
