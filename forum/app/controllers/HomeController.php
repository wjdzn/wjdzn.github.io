<?php

class HomeController extends BaseController
{

    public function getHome()
    {
        //Get all categories from the databases and paginate them.
        $categories = Category::orderBy('name', 'ASC')->paginate(5);
        $acategories = Category::orderBy('name', 'ASC')->get();
        return View::make('home.index', array('categories' => $categories, 'acategories' => $acategories));
    }

    public function getRegister()
    {
        if (Session::has('logged')) {
            return Redirect::to('/');
        } else {
            $first = rand(1, 9);
            $second = rand(1, 9);
            Session::put('result_reg', $first + $second);
            return View::make('home.register', array('first' => $first, 'second' => $second));
        }
    }

    public function getLogin()
    {
        if (Session::has('logged')) {
            return Redirect::to('/');
        } else {
            return View::make('home.login');
        }
    }

    public function getSearch()
    {
        $search = e(Input::get('query'));
        $users = User::where('first_name', 'LIKE', "%" . $search . "%")->orWhere('surname', 'LIKE', "%" . $search . "%")->orWhere('email', 'LIKE', '%' . $search . '%')->get();
        $categories = Category::where('name', 'LIKE', "%$search%")->get();
        $discussions = Discussion::where('title', 'LIKE', "%$search%")->get();
        $posts = Post::where('text', 'LIKE', "%$search%")->get();
        return View::make('home.search', array('categories' => $categories, 'discussions' => $discussions, 'posts' => $posts, 'users' => $users));
    }

    public function getTos()
    {
        return View::make('home.tos');
    }

}
