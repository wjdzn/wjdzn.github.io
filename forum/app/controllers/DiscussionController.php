<?php

class DiscussionController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        if (Session::has('logged')) {
            if (User::isMuted(Session::get('logged'))) {
                return Redirect::to('/');
            }
            $first = rand(1, 9);
            $second = rand(0, 10);
            Session::put('dis_answer', $first + $second);
            return View::make('discussion.create', array('cat_id' => $id, 'first' => $first, 'second' => $second));
        } else {
            return Redirect::to('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($id)
    {
        if (Session::has('logged')) {
            if (User::isMuted(Session::get('logged'))) {
                return Redirect::to('/');
            }
            $title = Input::get('title');
            if (mb_strlen(Input::get('title'), 'utf-8') > 1) {
                if (mb_strlen(Input::get('title'), 'utf-8') > 150) {
                    return Redirect::to('discussion/create/' . $id)->with('error', Lang::get('messages.too_long_title'));
                } else {
                    if (mb_strlen(Input::get('text'), 'utf-8') > 50) {
                        $by_id = User::where('email', Session::get('logged'))->first()->id;
                        if (mb_strlen(Input::get('title'), 'utf-8') > 20) {
                            if (strpos(Input::get('title'), ' ') === false) {
                                $title = Input::get('title');
                                $part = substr($title, strlen($title) / 2);
                                $title = substr_replace($title, ' ', strlen(Input::get('title')) / 2, strlen(Input::get('title')) / 2);
                                $title = $title . $part;
                            }
                        }
                        if (Session::has('dis_answer')) {
                            if (Session::get('dis_answer') == Input::get('answer')) {
                                if (!Input::get('announcement')) {
                                    Discussion::create(array(
                                        'title' => e(substr($title, 0, 150)),
                                        'description' => substr(Input::get('text'), 0, 2000),
                                        'cat_id' => e($id),
                                        'by_id' => $by_id
                                    ));
                                    return Redirect::to('category/' . $id)->with('success', Lang::get('messages.successifully_started_a_discussion'));
                                } else {
                                    Discussion::create(array(
                                        'title' => e(substr($title, 0, 150)),
                                        'description' => substr(Input::get('text'), 0, 2000),
                                        'type' => 'announcement',
                                        'by_id' => $by_id
                                    ));
                                    return Redirect::to('/');
                                }
                            } else {
                                return Redirect::to('discussion/create/' . $id)->withInput()->with('error', Lang::get('messages.wrong_answer'));
                            }
                        } else {
                            return Redirect::to('discussion/create/' . $id)->withInput()->with('error', Lang::get('messages.wrong_answer'));
                        }
                    } else {
                        return Redirect::to('discussion/create/' . $id)->withInput()->with('error', Lang::get('messages.too_short_description'));
                    }
                }
            } else {
                return Redirect::to('discussion/create/' . $id)->withInput()->with('error', Lang::get('messages.too_short_title'));
            }
        } else {
            return Redirect::to('login');
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
        $dis = Discussion::find($id);
        if ($dis != null) {
            if ($dis->type != "announcement") {
                $cat = Category::find($dis->cat_id);
                if ($cat->must_logged == 0 && $cat->min_membership == 1) {
                    if (!Session::has('viewed_dis/' . $dis->id)) {
                        Session::put('viewed_dis/' . $dis->id, $dis->id);
                        $dis->views+=1;
                        $dis->save();
                    }
                    return View::make('discussion.show', array('discussion' => $dis));
                } else {
                    if ($cat->must_logged == 1) {
                        if (Session::has('logged')) {
                            if (!Session::has('viewed_dis/' . $dis->id)) {
                                Session::put('viewed_dis/' . $dis->id, $dis->id);
                                $dis->views+=1;
                                $dis->save();
                            }
                            return View::make('discussion.show', array('discussion' => $dis));
                        } else {
                            return Redirect::to('login');
                        }
                    } else {
                        if (Session::has('logged')) {
                            if (User::where('email', Session::get('logged'))->first()->membership >= $cat->min_membership) {
                                if (!Session::has('viewed_dis/' . $dis->id)) {
                                    Session::put('viewed_dis/' . $dis->id, $dis->id);
                                    $dis->views+=1;
                                    $dis->save();
                                }
                                return View::make('discussion.show', array('discussion' => $dis));
                            } else {
                                return View::make('err.no_permissions');
                            }
                        } else {
                            return Redirect::to('login');
                        }
                    }
                }
            } else {
                if (!Session::has('viewed_dis/' . $dis->id)) {
                    Session::put('viewed_dis/' . $dis->id, $dis->id);
                    $dis->views+=1;
                    $dis->save();
                }
                return View::make('discussion.show', array('discussion' => $dis));
            }
        } else {
            return View::make('err.discussionnotfound');
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
        $dis = Discussion::find($id);
        if ($dis != null) {
            $user = User::find($dis->by_id);
            $cat = $dis->cat_id;
            if (Session::has('logged')) {
                if (Session::get('logged') == $user->email || User::where('email', Session::get('logged'))->first()->membership >= 3) {
                    return View::make('discussion.edit', array('dis' => $dis));
                }
            } else {
                return Redirect::to('login');
            }
        } else {
            return View::make('err.discussionnotfound');
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
        $dis = Discussion::find($id);
        if ($dis != null) {
            $user = User::find($dis->by_id);
            $cat = $dis->cat_id;
            if (Session::has('logged')) {
                if (Session::get('logged') == $user->email || User::where('email', Session::get('logged'))->first()->membership >= 3) {
                    if (mb_strlen(Input::get('title'), 'utf-8') > 1) {
                        $title = Input::get('title');
                        if (mb_strlen(Input::get('title'), 'utf-8') > 20) {
                            if (strpos(Input::get('title'), ' ') === false) {
                                $title = Input::get('title');
                                $part = substr($title, strlen($title) / 2);
                                $title = substr_replace($title, ' ', strlen(Input::get('title')) / 2, strlen(Input::get('title')) / 2);
                                $title = $title . $part;
                            }
                        }
                        if (mb_strlen(Input::get('text'), 'utf-8') > 50) {
                            if (Input::get('closed')) {
                                $dis->closed = 1;
                            } else {
                                $dis->closed = 0;
                            }
                            $dis->title = e(substr($title, 0, 150));
                            $dis->description = substr(Input::get('text'), 0, 2000);
                            $dis->save();
                            return Redirect::to('discussion/' . $dis->id);
                        } else {
                            return Redirect::to('discussion/' . $dis->id . '/edit')->with('error', Lang::get('messages.too_short_description'));
                        }
                    } else {
                        return Redirect::to('discussion/' . $dis->id . '/edit')->with('error', Lang::get('messages.too_short_title'));
                    }
                }
            } else {
                return Redirect::to('login');
            }
        } else {
            return View::make('err.discussionnotfound');
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
        if (Session::has('logged')) {
            $discussion = Discussion::find($id);
            $me = User::where('email', Session::get('logged'))->first();
            if ($discussion == null) {
                return Redirect::to('/');
            }
            if ($me->id == $discussion->by_id || $me->membership >= 3) {
                foreach ($discussion->posts()->get() as $post) {
                    $post->delete();
                }
                $discussion->delete();
            }
            return Redirect::to('category/' . $discussion->cat_id);
        } else {
            return Redirect::to('/');
        }
    }

    public function sort($cat_id, $type)
    {
        if (Session::has('sort/' . $cat_id)) {
            $order = Session::get('sort/' . $cat_id)[1];
        } else {
            $order = "DESC";
        }
        if ($order == "DESC") {
            $neworder = "ASC";
        } else {
            $neworder = "DESC";
        }
        Session::put('sort/' . $cat_id, array($type, $neworder));
        return Redirect::back();
    }

    public function dis_per_page($num)
    {
        if ($num != 10 && $num != 30 && $num != 50) {
            $num = 10;
        }
        Session::forget('dis_per_page');
        Session::put('dis_per_page', $num);
        return Redirect::back();
    }

}
