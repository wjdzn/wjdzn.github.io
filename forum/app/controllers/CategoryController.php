<?php

class CategoryController extends \BaseController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Session::has('logged')) {
            if (User::where('email', Session::get('logged'))->first()->membership >= 4) {
                return View::make('category.create');
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (Session::has('logged')) {
            if (User::where('email', Session::get('logged'))->first()->membership >= 4) {
                if (mb_strlen(Input::get('title'), 'utf-8') > 0) {
                    if (mb_strlen(Input::get('text'), 'utf-8') > 0) {
                        if (Input::get('membership')) {
                            $min_rank = e(Input::get('membership'));
                        } else {
                            $min_rank = 1;
                        }
                        if (Input::get('logged')) {
                            $must_logged = 1;
                        } else {
                            $must_logged = 0;
                        }
                        Category::create(array(
                            'name' => substr(e(Input::get('title')), 0, 100),
                            'description' => substr(Input::get('text'), 0, 2000),
                            'min_membership' => $min_rank,
                            'must_logged' => $must_logged
                        ));
                        return Redirect::to('/');
                    } else {
                        return Redirect::to('category/create')->with('error', Lang::get('messages.too_short_description'));
                    }
                } else {
                    return Redirect::to('category/create')->with('error', Lang::get('messages.too_short_name'));
                }
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        if ($category != null) {
            if ($category->must_logged == 1) {
                return View::make('category.show', array('category' => $category));
                if (!Session::has('logged')) {
                    return Redirect::to('login');
                }
            } else {
                if ($category->min_membership > 1) {
                    if (Session::has('logged')) {
                        if (User::where('email', Session::get('logged'))->first()->membership >= $category->min_membership) {
                            return View::make('category.show', array('category' => $category));
                        } else {
                            return View::make('err.permissions');
                        }
                    } else {
                        return View::make('err.permissions');
                    }
                } else {
                    return View::make('category.show', array('category' => $category));
                }
            }
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            $cat = Category::find($id);
            if ($cat != null) {
                if ($me->membership >= 4) {
                    return View::make('category.edit', array('category' => $cat));
                } else {
                    return Redirect::to('/');
                }
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            $cat = Category::find($id);
            if ($cat == null) {
                return Redirect::to('/');
            } else {
                if (mb_strlen(Input::get('name'), 'utf-8') > 0) {
                    if (mb_strlen(Input::get('text'), 'utf-8') > 0) {
                        if (Input::get('membership')) {
                            $min_rank = e(Input::get('membership'));
                        } else {
                            $min_rank = 1;
                        }
                        if (Input::get('logged')) {
                            $must_logged = 1;
                        } else {
                            $must_logged = 0;
                        }
                        $cat->name = substr(e(Input::get('name')), 0, 100);
                        $cat->description = substr(Input::get('text'), 0, 2000);
                        $cat->min_membership = $min_rank;
                        $cat->must_logged = $must_logged;
                        $cat->save();
                        return Redirect::to('/');
                    } else {
                        return Redirect::to('category/' . $id . '/edit')->with('error', Lang::get('messages.too_short_description'));
                    }
                } else {
                    return Redirect::to('category/' . $id . '/edit')->with('error', Lang::get('messages.too_short_name'));
                }
            }
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return Redirect::to('/');
        } else {
            if (Session::has('logged')) {
                $me = User::where('email', Session::get('logged'))->first();
                if ($me->membership >= 4) {
                    foreach ($category->discussions()->get() as $dis) {
                        foreach ($dis->posts()->get() as $post) {
                            $post->delete();
                        }
                        $dis->delete();
                    }
                    $category->delete();
                    return Redirect::back();
                } else {
                    return Redirect::to('/');
                }
            } else {
                return Redirect::to('/');
            }
        }
    }

}
