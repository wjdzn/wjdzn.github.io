<?php

class PostController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Redirect::to('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Redirect::to('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (Session::has('logged')) {
            $dis = Discussion::find(e(Input::get('dis')));
            $user = User::where('email', Session::get('logged'))->first();
            if ($dis != null) {
                if (!User::isMuted(Session::get('logged'))) {
                    if (mb_strlen(Input::get('reply'), 'utf-8') > 0) {
                        Post::create(array(
                            'by' => $user->id,
                            'dis_id' => $dis->id,
                            'likes' => 0,
                            'text' => substr(Input::get('reply'), 0, 2000)
                        ));
                        $user->points+=1;
                        $user->save();
                    }
                }
                return Redirect::back();
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
            $post = Post::find($id);
            if ($post == null) {
                return Redirect::to('/');
            }
            if ($me->id == $post->by || $me->membership >= 3) {
                return View::make('post.edit', array('post' => $post));
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('login');
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
            $post = Post::find($id);
            if ($post == null) {
                return Redirect::to('/');
            }
            if ($me->id == $post->by || $me->membership >= 3) {
                $post->text = substr(Input::get('reply'), 0, 2000);
                $post->save();
                return Redirect::to('discussion/' . $post->dis_id);
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('login');
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
            $post = Post::find($id);
            $user = User::where('email', Session::get('logged'))->first();
            if ($user->id == $post->by || $user->membership >= 3) {
                $post->delete();
                $user->points--;
                $user->save();
            }
            return Redirect::back();
        } else {
            return Redirect::back();
        }
    }

    public function like($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            $post = Post::find($id);
            if ($post != null) {
                $user = User::find($post->by);
                if (Like::where('by_id', $me->id)->where('post_id', $id)->count() < 1) {
                    Like::create(array(
                        'post_id' => $id,
                        'by_id' => $me->id
                    ));
                    $post->likes+=1;
                    $post->save();
                    $user->points+=1;
                    $user->save();
                    return Redirect::back();
                }
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function report($type, $id)
    {
        if (Session::has('logged')) {
            if ($type == 1) {
                $en = Post::find($id);
            }
            if ($type == 2) {
                $en = Discussion::find($id);
            }
            if ($type != 1 && $type != 2) {
                return Redirect::to('/');
            }
            if ($en == null) {
                return Redirect::to('/');
            }
            if ($type == 1) {
                $type_var = "Post";
            } else {
                if ($type == 2) {
                    $type_var = "Discussion";
                }
            }
            return View::make('post.report', array('entity' => $en, 'type' => $type_var));
        } else {
            return Redirect::to('/');
        }
    }

    public function postReport()
    {
        if (Session::get('logged')) {
            if (mb_strlen(trim(Input::get('report')), 'utf-8') < 20) {
                return Redirect::to('report/' . Input::get('type') . '/' . Input::get('id'))->with('error', Lang::get('messages.too_short_report'));
            }
            Report::create(array(
                'type' => e(Input::get('type')),
                'by_id' => User::where('email', Session::get('logged'))->first()->id,
                'entity_id' => e(Input::get('id')),
                'report' => e(substr(Input::get('report'), 0, 1000))
            ));
            return Redirect::to('report/' . Input::get('type') . '/' . Input::get('id'))->with('success', Lang::get('messages.successifully_sent_report'));
        } else {
            return Redirect::to('/');
        }
    }

}
