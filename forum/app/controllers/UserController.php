<?php

class UserController extends BaseController
{

    public function logout()
    {
        $info = User::where('email', Session::get('logged'))->first();
        $info->last_seen = 0;
        $info->save();
        if (Session::has('logged')) {
            Session::forget('logged');
        }
        return Redirect::to('/');
    }

    public function create()
    {
        global $smtp_username;
        if (Session::has('logged')) {
            return Redirect::to('/');
        } else {
            if (Ban::where('bannedIp', 1)->where('ip', Request::getClientIp())->where('ban_to', '>', time())->count() > 0) {
                return Redirect::to('register', Lang::get('messages.you_are_banned'));
            }
            $data = array(
                Lang::get('messages.e-mail') => Input::get('email'),
                Lang::get('messages.password') => Input::get('password'),
                Lang::get('messages.first_name') => Input::get('first_name'),
                Lang::get('messages.surname') => Input::get('surname')
            );
            $rules = array(
                Lang::get('messages.password') => 'required|min:6',
                Lang::get('messages.e-mail') => 'required|email|unique:t_users,email',
                Lang::get('messages.first_name') => 'required',
                Lang::get('messages.surname') => 'required',
            );
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return Redirect::to('register')->withInput(Input::except('password'))->with('errors_reg', $validator->messages());
            } else {
                if (Session::get('result_reg') != Input::get('answer')) {
                    return Redirect::to('register')->withInput(Input::except('password'))->with('error_reg', Lang::get('messages.wrong_answer'));
                } else {
                    if (Settings::first()->tos == 1) {
                        if (!Input::get('tos')) {
                            return Redirect::to('register')->withInput(Input::except('password'))->with('error_reg', Lang::get('messages.tos_required'));
                        }
                    }
                    if (Settings::first()->acc_activation == 1) {
                        $code = str_random(12);
                        User::create(array(
                            'email' => e(Input::get('email')),
                            'password' => md5(e(Input::get('password')) . "forumiumpro"),
                            'first_name' => e(Input::get('first_name')),
                            'surname' => e(Input::get('surname')),
                            'country' => e(Input::get('country')),
                            'ip' => Request::getClientIp(),
                            'membership' => 1,
                            'activated' => 0,
                            'activation_code' => $code
                        ));
                        $user = User::where('email', e(Input::get('email')))->first();
                        Profile::create(array(
                            'user_id' => $user->id
                        ));
                        Mail::send('mail.activate', array('code' => $code, 'acc' => $user->id), function($message) {
                            $message->sender(Config::get('mail.username'));
                            $message->to(Input::get('email'), Input::get('first_name') . " " . Input::get('surname'))
                                    ->subject(Lang::get('messages.activate_your_account'));
                        });
                        return Redirect::to('login')->with('success', Lang::get('messages.register_success_you_must_active_your_account'));
                    } else {
                        User::create(array(
                            'email' => e(Input::get('email')),
                            'password' => md5(e(Input::get('password')) . "forumiumpro"),
                            'first_name' => e(Input::get('first_name')),
                            'surname' => e(Input::get('surname')),
                            'country' => e(Input::get('country')),
                            'ip' => Request::getClientIp(),
                            'membership' => 1,
                            'activated' => 1
                        ));
                        $user = User::where('email', e(Input::get('email')))->first();
                        Profile::create(array(
                            'user_id' => $user->id
                        ));
                        return Redirect::to('login')->with('success', Lang::get('messages.register_success'));
                    }
                }
            }
        }
    }

    public function login()
    {
        if (!Session::has('logged')) {
            $check = User::where('email', e(Input::get('email')))->where('password', md5(e(Input::get('password')) . "forumiumpro"))->first();
            if ($check == null) {
                return Redirect::to('login')->with('error', Lang::get('messages.wrong_email/password'));
            } else {
                if (Ban::where('bannedIp', 1)->where('ip', Request::getClientIp())->where('ban_to', '>', time())->count() > 0) {
                    return Redirect::to('login')->with('error', Lang::get('messages.you_are_banned') . " " . date('Y-m-d h:i:s', Ban::where('bannedIp', 1)->where('ip', Request::getClientIp())->where('ban_to', '>', time())->first()->ban_to));
                }
                if (Ban::where('bannedUser', 1)->where('user_id', $check->id)->where('ban_to', '>', time())->count() > 0) {
                    return Redirect::to('login')->with('error', Lang::get('messages.acc_banned') . " " . date('Y-m-d h:i:s', Ban::where('bannedUser', 1)->where('user_id', $check->id)->where('ban_to', '>', time())->first()->ban_to));
                }
                if ($check->password != "") {
                    if ($check->activated == 0) {
                        return Redirect::to('login')->with('error', Lang::get('messages.account_not_activated'));
                    } else {
                        Session::put('logged', $check->email);
                    }
                } else {
                    return Redirect::to('login')->with('error', Lang::get('messages.wrong_email/password'));
                }
            }
        }
        return Redirect::to('/');
    }

    public function fbLogin()
    {
        $facebook = new Facebook(Config::get('facebook'));
        $params = array(
            'redirect_uri' => url('fbLogin/callback'),
            'scope' => 'email',
        );
        return Redirect::to($facebook->getLoginUrl($params));
    }

    public function fbLoginCall()
    {
        $code = Input::get('code');
        if (strlen($code) == 0)
            return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

        $facebook = new Facebook(Config::get('facebook'));
        $uid = $facebook->getUser();

        if ($uid == 0)
            return Redirect::to('/')->with('message', 'There was an error');

        $me = $facebook->api('/me');

        $check = User::where('email', $me['email'])->first();
        if ($check != null) {
            if ($check->password == "" && $check->fb_id != "") {
                Session::put('logged', $check->email);
            } else {
                return Redirect::to('login')->with('error', Lang::get('messages.user_with_this_email_exists'));
            }
        } else {
            User::create(array(
                'email' => e($me['email']),
                'first_name' => e($me['first_name']),
                'surname' => e($me['last_name']),
                'country' => explode('_', e($me['locale']))[1],
                'gender' => e($me['gender']),
                'ip' => Request::getClientIp(),
                'membership' => 1,
                'fb_id' => e($me['id']),
                'activated' => 1
            ));
            $user = User::where('email', e($me['email']))->first();
            Profile::create(array(
                'user_id' => $user->id
            ));
            Session::put('logged', $me['email']);
        }
        return Redirect::to('/');
    }

    public function showProfile($email)
    {
        $user = User::where('email', e($email))->first();
        if ($user != null) {
            if (!Session::has('seen' . $user->id)) {
                $user = User::find($user->id);
                $user->views+=1;
                $user->save();
                Session::put('seen' . $user->id, $user->id);
            }
            $num_friends = Friendship::where(function($query) use($user) {
                        $query->where('acc_1', $user->id)->
                                orWhere('acc_2', $user->id);
                    })->where('status', 1)->count();
            $friends = Friendship::where(function($query) use($user) {
                        $query->where('acc_1', $user->id)->
                                orWhere('acc_2', $user->id);
                    })->where('status', 1)->orderBy('created_at', 'ASC')->limit(10)->get();
            return View::make('user.profile', array('user' => $user, 'friends' => $friends, 'num_friends' => $num_friends));
        } else {
            return View::make('404.user_not_found');
        }
    }

    public function postChangeImg()
    {
        if (Session::has('logged')) {
            $user = User::where('email', Session::get('logged'))->first();
            $file = Input::file('file');
            if ($file->getMimeType() != "image/jpeg" && $file->getMimeType() != "image/png") {
                return Redirect::to('profile/' . $user->email)->with('error', Lang::get('messages.wrong_image'));
            } else
                $ext = "." . explode(".", $file->getClientOriginalName())[1];
            $settings = Settings::first();
            if ($file->getSIze() > ($settings->max_pic_upload_size * 1024)) {
                return Redirect::to('profile/' . $user->email)->with('error', Lang::get('messages.too_big_image'));
            }
            if (File::exists('assets/images/profile/' . $user->id . '.jpg') || File::exists('assets/images/profile/' . $user->id . '.png')) {
                if (File::exists('assets/images/profile/' . $user->id . '.jpg')) {
                    File::delete('assets/images/profile/' . $user->id . '.jpg');
                    if (File::exists('assets/images/profile/' . $user->id . '.png')) {
                        File::delete('assets/images/profile/' . $user->id . '.png');
                    }
                } else {
                    File::delete('assets/images/profile/' . $user->id . '.png');
                }
            }
            $file->move('assets/images/profile/', $user->id . $ext);
            return Redirect::to('profile/' . $user->email)->with('success', Lang::get('messages.image_success'));
        } else {
            return Redirect::to('/');
        }
    }

    public function restoreFb()
    {
        if (Session::has('logged')) {
            $user = User::where("email", Session::get('logged'))->first();
            if ($user->fb_id != "") {
                if (File::exists('assets/images/profile/' . $user->id . '.jpg') || File::exists('assets/images/profile/' . $user->id . '.png')) {
                    if (File::exists('assets/images/profile/' . $user->id . '.jpg')) {
                        File::delete('assets/images/profile/' . $user->id . '.jpg');
                    } else {
                        File::delete('assets/images/profile/' . $user->id . '.png');
                    }
                }
            }
            return Redirect::to('profile/' . Session::get('logged'));
        } else {
            return Redirect::to('/');
        }
    }

    public function setPasswordPage()
    {
        if (Session::has('logged')) {
            $user = User::where('email', Session::get('logged'))->first();
            if ($user->fb_id != "" && $user->password == "") {
                return View::make('user.setPassword');
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function setPassword()
    {
        if (Session::has('logged')) {
            $user = User::where('email', Session::get('logged'))->first();
            if ($user->fb_id != "" && $user->password == "") {
                if (mb_strlen(Input::get('password'), 'utf-8') > 5) {
                    $user = User::find($user->id);
                    $user->password = md5(e(Input::get('password')) . "forumiumpro");
                    $user->fb_id = "";
                    $user->save();
                    return Redirect::to('profile/' . $user->email)->with('success', Lang::get('messages.successifully_set_password'));
                } else {
                    return Redirect::to('user/set_password')->with('error', Lang::get('messages.min_pass_6'));
                }
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function changePasswordPage()
    {
        if (Session::has('logged')) {
            $user = User::where('email', Session::get('logged'))->first();
            if ($user->fb_id != "" || $user->password == "") {
                return Redirect::to('profile/' . $user->email);
            } else {
                return View::make('user.changePassword');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function changePassword()
    {
        if (Session::has('logged')) {
            $user = User::where('email', Session::get('logged'))->first();
            if ($user->fb_id != "" || $user->password == "") {
                return Redirect::to('profile/' . $user->email);
            } else {
                if ($user->password != md5(Input::get('old_password') . "forumiumpro")) {
                    return Redirect::to('user/change_password')->with('error', Lang::get('messages.old_password_is_not_correct'));
                } else {
                    if (mb_strlen(Input::get('new_password'), 'utf-8') > 5) {
                        $user = User::find($user->id);
                        $user->password = md5(e(Input::get('new_password')) . "forumiumpro");
                        $user->save();
                        return Redirect::to('user/change_password')->with('success', Lang::get('messages.successifully_changed_password'));
                    } else {
                        return Redirect::to('user/change_password')->with('error', Lang::get('messages.new_password_is_too_short'));
                    }
                }
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function updateDescription()
    {
        if (Session::has('logged')) {
            $profile = Profile::find(User::where('email', Session::get('logged'))->first()->profile()->first()->id);
            $profile->about = e(substr(Input::get('about'), 0, 2000));
            $profile->about_public = e(Input::get('public'));
            $profile->save();
            return Redirect::to('profile/' . Session::get('logged'));
        } else {
            return Redirect::to('/');
        }
    }

    public function updateCity()
    {
        if (Session::has('logged')) {
            $profile = Profile::find(User::where('email', Session::get('logged'))->first()->profile()->first()->id);
            $profile->city = e(substr(Input::get('city'), 0, 50));
            $profile->city_public = e(Input::get('public'));
            $profile->save();
            return Redirect::to('profile/' . Session::get('logged'));
        } else {
            return Redirect::to('/');
        }
    }

    public function updateJob()
    {
        if (Session::has('logged')) {
            $profile = Profile::find(User::where('email', Session::get('logged'))->first()->profile()->first()->id);
            $profile->job = e(substr(Input::get('job'), 0, 50));
            $profile->job_public = e(Input::get('public'));
            $profile->save();
            return Redirect::to('profile/' . Session::get('logged'));
        } else {
            return Redirect::to('/');
        }
    }

    public function mySettings()
    {
        if (Session::has('logged')) {
            $user = User::where('email', Session::get('logged'))->first();
            return View::make('user.mySettings', array('user' => $user));
        } else {
            return Redirect::to('/');
        }
    }

    public function updateProfile()
    {
        if (Session::has('logged')) {
            $profile = User::where('email', Session::get('logged'))->first()->profile()->first();
            $profile->about = e(Input::get('description'));
            $profile->about_public = e(substr(Input::get('city_public'), 0, 2000));
            $profile->city = e(Input::get('city'));
            $profile->city_public = e(substr(Input::get('city_public'), 0, 50));
            $profile->job = e(Input::get('job'));
            $profile->job_public = e(substr(Input::get('city_public'), 0, 50));
            $profile->save();
            return Redirect::to('profile/' . Session::get('logged'))->with('success', Lang::get('messages.successifully_updated_profile'));
        } else {
            return Redirect::to('/');
        }
    }

    public function addFriend($id)
    {
        if (Session::has('logged')) {
            if (User::find($id) != null) {
                $my_id = User::where('email', Session::get('logged'))->first()->id;
                $email = User::find(e($id))->email;
                if (Friendship::areFriends($my_id, $id)) {
                    Friendship::deletef($my_id, $id);
                    return Redirect::to('profile/' . $email)->with('success', Lang::get('messages.successifully_removed_from_friends_list'));
                } else {
                    if (Friendship::exists($my_id, $id)) {
                        Friendship::deletef($my_id, $id);
                        return Redirect::to('profile/' . $email)->with('success', Lang::get('messages.successifully_cancelled_request'));
                    } else {
                        Friendship::create(array(
                            'acc_1' => $my_id,
                            'acc_2' => e($id),
                            'status' => 0
                        ));
                        return Redirect::to('profile/' . $email)->with('success', Lang::get('messages.friend_request_successifully_sent'));
                    }
                }
            } else {
                return View::make('404.user');
            }
        }
    }

    public function friendRequests()
    {
        if (Session::has('logged')) {
            $id = User::where('email', Session::get('logged'))->first()->id;
            if (Session::has('requests_paginate')) {
                $per_page = Session::get('requests_paginate');
            } else {
                $per_page = 10;
            }
            $requests = Friendship::where(function($query) use ($id) {
                        $query->where('acc_2', $id)->orWhere('acc_1', $id);
                    })->where('status', 0)->paginate($per_page);
            return View::make('user.friendRequests', array('requests' => $requests));
        } else {
            return Redirect::to('/');
        }
    }

    public function acceptRequest($id)
    {
        if (Session::has('logged')) {
            if (Friendship::find(e($id)) != null) {
                $my_id = User::where('email', Session::get('logged'))->first()->id;
                if (Friendship::where('acc_2', $my_id)->first() != null) {
                    $request = Friendship::find(Friendship::where('acc_2', $my_id)->first()->id);
                    $request->status = 1;
                    $request->save();
                    $info = User::find($request->acc_1);
                    $name = $info->first_name . " " . $info->surname . " ";
                    return Redirect::to('friend_requests')->with('success', $name . Lang::get('messages.is_now_your_friend'));
                } else {
                    return Redirect::to('friend_requests');
                }
            } else {
                return Redirect::to('friend_requests');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function activate($code, $acc)
    {
        if (Session::has('logged')) {
            return Redirect::to('/');
        } else {
            $check = User::find($acc);
            if ($check != null) {
                if ($check->activated == 0) {
                    if ($code == $check->activation_code) {
                        $check->activated = 1;
                        $check->save();
                        return Redirect::to('login')->with('success', Lang::get('messages.successifully_activated_account'));
                    }
                } else {
                    return Redirect::to('activate')->with('error', Lang::get('messages.this_account_has_been_already_activated'));
                }
            } else {
                return Redirect::to('activate')->with('error', Lang::get('messages.the_user_does_not_exist'));
            }
        }
    }

    public function activatePost()
    {
        if (Session::has('logged')) {
            return Redirect::to('/');
        } else {
            $check = User::where('email', e(Input::get('email')))->first();
            if ($check != null) {
                if ($check->activated == 0) {
                    if (Input::get('code') == $check->activation_code) {
                        $check->activated = 1;
                        $check->save();
                        return Redirect::to('login')->with('success', Lang::get('messages.successifully_activated_account'));
                    }
                } else {
                    return Redirect::to('activate')->with('error', Lang::get('messages.this_account_has_been_already_activated'));
                }
            } else {
                return Redirect::to('activate')->with('error', Lang::get('messages.the_user_does_not_exist'));
            }
        }
    }

    public function activationPage()
    {
        if (!Session::has('logged')) {
            return View::make('user.activate');
        } else {
            return Redirect::to('/');
        }
    }

    public function forgotPasswordPage()
    {
        if (!Session::has('logged')) {
            return View::make('user.forgot');
        } else {
            return Redirect::to('/');
        }
    }

    public function forgotPassword()
    {
        if (!Session::has('logged')) {
            if (User::where('email', e(Input::get('email')))->count() > 0) {
                $user = User::where('email', e(Input::get('email')))->first();
                $newpass = str_random(8);
                $user->password = md5($newpass . "forumiumpro");
                $user->save();
                Mail::send('mail.forgot', array('newpass' => $newpass, 'login' => URL::to('login')), function($message) use($user) {
                    $message->sender(Config::get('mail.username'));
                    $message->to(Input::get('email'), $user->first_name . " " . $user->surname)
                            ->subject(Lang::get('messages.forgot_password'));
                });
                return Redirect::to('forgot')->with('success', Lang::get('messages.we_have_sent_your_new_password_to_your_email'));
            } else {
                return Redirect::to('forgot')->with('error', Lang::get('messages.user_with_this_email_does_not_exist'));
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function getMail($type)
    {
        if (Session::has('logged')) {
            if (!Session::has('mail_order_by')) {
                Session::put('mail_order_by', array('created_at', 'DESC'));
            }
            $me = User::where('email', Session::get('logged'))->first();
            if ($type == 1) {
                $mails = Message::where('deleted', 0)->where('box', $me->id)->where('msg_to', $me->id)->orderBy(Session::get('mail_order_by')[0], Session::get('mail_order_by')[1])->paginate(10);
            } else {
                if ($type == 2) {
                    $mails = Message::where('deleted', 0)->where('box', $me->id)->where('msg_from', $me->id)->orderBy(Session::get('mail_order_by')[0], Session::get('mail_order_by')[1])->paginate(10);
                } else {
                    if ($type == 3) {
                        $mails = Message::where(function ($query) use ($me) {
                                    $query->where('msg_from', '=', $me->id)
                                            ->orWhere('msg_to', '=', $me->id);
                                })->where('deleted', 1)->where('box', $me->id)->orderBy(Session::get('mail_order_by')[0], Session::get('mail_order_by')[1])->paginate(10);
                    } else {
                        return Redirect::to('/');
                    }
                }
            }
            return View::make('user.mail', array('mails' => $mails, 'type' => $type));
        } else {
            return Redirect::to('/');
        }
    }

    public function setMailOrder($by)
    {
        if (Session::has('mail_order_by')) {
            if (Session::get('mail_order_by')[1] == "DESC") {
                $type = "ASC";
            } else {
                $type = "DESC";
            }
        } else {
            $type = "ASC";
        }
        if ($by == "title" || $by == "created_at") {
            Session::put('mail_order_by', array($by, $type));
        }
        return Redirect::back();
    }

    public function deleteMail()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            $array = Input::get('delete');
            $count = 0;
            if (count($array) < 1) {
                return Redirect::back()->with('error', Lang::get('messages.you_must_select_at_least_one_mail'));
            }
            foreach ($array as $id) {
                $mail = Message::find(e($id));
                if (($mail->msg_from == $me->id || $mail->msg_to == $me->id) && $mail->box == $me->id) {
                    $mail->deleted = 1;
                    $mail->save();
                }
                $count++;
            }
            return Redirect::back()->with('success', Lang::get('messages.successifully_deleted') . " " . $count . " " . Lang::get('messages.mails'));
        }
    }

    public function restoreMail()
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            $array = Input::get('delete');
            $count = 0;
            if (count($array) < 1) {
                return Redirect::back()->with('error', Lang::get('messages.you_must_select_at_least_one_mail'));
            }
            foreach ($array as $id) {
                $mail = Message::find(e($id));
                if (($mail->msg_from == $me->id || $mail->msg_to == $me->id) && $mail->box == $me->id) {
                    $mail->deleted = 0;
                    $mail->save();
                }
                $count++;
            }
            return Redirect::back()->with('success', Lang::get('messages.successifully_restored') . " " . $count . " " . Lang::get('messages.mails'));
        }
    }

    public function sendMessage($id)
    {
        if (Session::has('logged')) {
            $user = User::find($id);
            $first = rand(4, 10);
            $second = rand(1, 10);
            Session::put('mail_answer', $first + $second);
            if ($user != null) {
                return View::make('mail.create', array('first' => $first, 'second' => $second));
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('login');
        }
    }

    public function postSendMessage()
    {
        if (Session::has('logged')) {
            $user = User::find(e(Input::get('to_id')));
            $me = User::where('email', Session::get('logged'))->first();
            if ($user != null) {
                if (mb_strlen(Input::get('title'), 'utf-8') < 3) {
                    return Redirect::to('message/create/' . $user->id)->with('error', Lang::get('messages.too_short_title'));
                } else {
                    if (mb_strlen(Input::get('text'), 'utf-8') >= 50) {
                        if (Input::get('answer') != Session::get('mail_answer')) {
                            return Redirect::to('message/create/' . $user->id)->with('error', Lang::get('messages.wrong_answer'));
                        } else {
                            $title = Input::get('title');
                            if (mb_strlen(Input::get('title'), 'utf-8') > 20) {
                                if (strpos(Input::get('title'), ' ') === false) {
                                    $part = substr($title, strlen($title) / 2);
                                    $title = substr_replace($title, ' ', strlen(Input::get('title')) / 2, strlen(Input::get('title')) / 2);
                                    $title = $title . $part;
                                }
                            }
                            Message::create(array(
                                'msg_from' => $me->id,
                                'msg_to' => $user->id,
                                'title' => substr(e($title), 0, 155),
                                'msg' => substr(Input::get('text'), 0, 1000),
                                'read' => 0,
                                'box' => $me->id
                            ));
                            Message::create(array(
                                'msg_from' => $me->id,
                                'msg_to' => $user->id,
                                'title' => substr(e($title), 0, 155),
                                'msg' => substr(Input::get('text'), 0, 1000),
                                'read' => 0,
                                'box' => $user->id
                            ));
                        }
                    } else {
                        return Redirect::to('message/create/' . $user->id)->with('error', Lang::get('messages.too_short_message'));
                    }
                }

                return Redirect::to('message/create/' . $user->id)->with('success', Lang::get('messages.successifully_sent_message_to') . " " . $user->email);
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('login');
        }
    }

    public function ajaxSend()
    {
        $by = User::find(e(Input::get('by')));
        $to = User::where('email', e(Input::get('to')))->first();
        if ($to != null) {
            if ($to->id != $by->id) {
                if (strlen(Input::get('title')) < 3) {
                    return 3;
                } else {
                    if (strlen(Input::get('text')) < 50) {
                        return 4;
                    } else {
                        $title = Input::get('title');
                        if (mb_strlen(Input::get('title'), 'utf-8') > 20) {
                            if (strpos(Input::get('title'), ' ') === false) {
                                $part = substr($title, strlen($title) / 2);
                                $title = substr_replace($title, ' ', strlen(Input::get('title')) / 2, strlen(Input::get('title')) / 2);
                                $title = $title . $part;
                            }
                        }
                        Message::create(array(
                            'msg_from' => $by->id,
                            'msg_to' => $to->id,
                            'title' => substr(e($title), 0, 155),
                            'msg' => substr(Input::get('text'), 0, 1000),
                            'read' => 0,
                            'box' => $by->id
                        ));
                        Message::create(array(
                            'msg_from' => $by->id,
                            'msg_to' => $to->id,
                            'title' => substr(e($title), 0, 155),
                            'msg' => substr(Input::get('text'), 0, 1000),
                            'read' => 0,
                            'box' => $to->id
                        ));
                        return 5;
                    }
                }
            } else {
                return 2;
            }
        } else {
            return 1;
        }
    }

    public function showMessage($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            $message = Message::find($id);
            if ($message == null) {
                return Redirect::to('/');
            } else {
                if ($message->read == 0) {
                    $message->read = 1;
                    $message->save();
                }
                return View::make('mail.show', array('message' => $message));
            }
        }
        return $id;
    }

    public function checkPassword()
    {
        if (Request::ajax()) {
            $check = User::where('email', e(Input::get('email')))->where('password', md5(e(Input::get('password')) . 'forumiumpro'))->count();
            if ($check > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 'BAD REQUEST';
        }
    }

    public function userDelete($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            if ($me->membership >= 4) {
                $user = User::find($id);
                if ($user != null) {
                    foreach (Discussion::where('by_id', $user->id)->get() as $dis) {
                        $dis->delete();
                    }
                    foreach (Post::where('by', $user->id)->get() as $post) {
                        $post->delete();
                    }
                    foreach (Friendship::where('acc_1', $user->id)->orWhere('acc_2', $user->id)->get() as $fr) {
                        $fr->delete();
                    }
                    foreach (Message::where('msg_from', $user->id)->orWhere('msg_to', $user->id)->get() as $msg) {
                        $msg->delete();
                    }
                    foreach (Report::where('by_id', $user->id)->get() as $report) {
                        $report->delete();
                    }
                    if (File::exists('assets/images/profile/' . $user->id . '.jpg') || File::exists('assets/images/profile/' . $user->id . '.png')) {
                        if (File::exists('assets/images/profile/' . $user->id . '.jpg')) {
                            File::delete('assets/images/profile/' . $user->id . '.jpg');
                            if (File::exists('assets/images/profile/' . $user->id . '.png')) {
                                File::delete('assets/images/profile/' . $user->id . '.png');
                            }
                        } else {
                            File::delete('assets/images/profile/' . $user->id . '.png');
                        }
                    }
                    $user->delete();
                }
                return Redirect::back();
            } else {
                return Redirect::to('/');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function rejectRequest($id)
    {
        if (Session::has('logged')) {
            $me = User::where('email', Session::get('logged'))->first();
            $friendship = Friendship::where('acc_2', $me->id)->where('status', 0)->first();
            if ($friendship != null) {
                $friendship->delete();
            }
            return Redirect::back();
        } else {
            return Redirect::to('/');
        }
    }

}
